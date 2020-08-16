package com.example.aplikasiabsensi;

import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.util.TypedValue;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.Toolbar;

import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import android.content.Context;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import com.example.aplikasiabsensi.api.client;
import com.example.aplikasiabsensi.interfaces.InitComponent;

import com.example.aplikasiabsensi.model.model_absen.DataAbsen;
import com.example.aplikasiabsensi.model.model_absen.ResponseAbsen;
import com.example.aplikasiabsensi.model.model_user.DataUser;
import com.example.aplikasiabsensi.model.model_user.ResponseLogin;
import com.example.aplikasiabsensi.preference.user_pref;
import com.google.android.material.navigation.NavigationView;
import com.pixplicity.easyprefs.library.Prefs;

import java.sql.Time;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class HomeActivity extends AppCompatActivity implements InitComponent, View.OnClickListener {
    private Button absen_masuk, absen_pulang, logout;
    private TextView date_info, instruction, holiday;
    //Declare context
    private Context mContext;
    //Declare the data of the user
    private DataAbsen data_absen;
    //Declare progress dialog
    private ProgressDialog pDialog;
    //Menentukan hari
    SimpleDateFormat sdf = new SimpleDateFormat("EEEE");
    Date d = new Date();
    String day = sdf.format(d);
    boolean isWeekend = day.equals("Saturday")||day.equals("Sunday");

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        mContext=this;
        startInit();
    }

    @Override
    public void initUI() {
        absen_masuk=findViewById(R.id.buttonmasuk);
        absen_pulang=findViewById(R.id.buttonpulang);
        if(isWeekend){
            absen_masuk.setVisibility(View.INVISIBLE);
            absen_pulang.setVisibility(View.INVISIBLE);
        }
        logout=findViewById(R.id.button_logout);
        //Menampilkan tanggal
        date_info = findViewById(R.id.date_info);
        SimpleDateFormat complete_format = new SimpleDateFormat("EEEE, dd-MM-yyyy HH:mm:ss 'WIB'");
        String date = complete_format.format(d);
        date_info.setText(date);
        //Menampilkan teks
        instruction = findViewById(R.id.button_instruction);
        if(!isWeekend){
            instruction.setText("KLIK TOMBOL DI BAWAH INI UNTUK MELAKUKAN ABSENSI");
            instruction.setTextSize(TypedValue.COMPLEX_UNIT_DIP, 10);
            instruction.setTextColor(Color.BLACK);
        } else {
            instruction.setText("HARI INI LIBUR. ANDA TIDAK PERLU MELAKUKAN ABSENSI");
            instruction.setTextSize(TypedValue.COMPLEX_UNIT_DIP, 20);
            instruction.setTextColor(Color.BLUE);
        }
    }

    @Override
    public void startInit() {
        initToolbar();
        initUI();
        initValue();
        initEvent();
    }

    @Override
    public void initToolbar() {
        getSupportActionBar().hide();
    }

    @Override
    public void initValue() {
        //Only do from the parent class

    }

    @Override
    public void initEvent() {
        absen_masuk.setOnClickListener(this);
        absen_pulang.setOnClickListener(this);
        logout.setOnClickListener(this);
    }


   @Override
    public void onClick(View view) {
        switch (view.getId()) {
            case R.id.buttonmasuk:
                doAbsenMasuk();
                break;
            case R.id.buttonpulang:
                doAbsenPulang();
                break;
            case R.id.button_logout:
                logout();
                break;
        }
    }

    public void doAbsenMasuk(){
        pDialog = new ProgressDialog(this);
        //  pDialog.getProgressHelper().setBarColor(Color.parseColor("#A5DC86"));
        pDialog.setMessage("Melakukan absensi");
        pDialog.setCancelable(false);
        // pDialog.setIndeterminate(false);
        pDialog.show();
        int id = Prefs.getInt(user_pref.getIdUser(), 0);
        Log.d("data user", String.valueOf(id));


        final Call<ResponseAbsen> absen_masuk= client.getApi().masuk(id);
        absen_masuk.enqueue(new Callback<ResponseAbsen>() {
            @Override
            public void onResponse(Call<ResponseAbsen> call, Response<ResponseAbsen> response) {
                pDialog.hide();
                if (response.isSuccessful()){
                    if (response.body().getStatus()){
                        data_absen = response.body().getData();
                        //Kalau absen berhasil
                        Toast.makeText(mContext,"Absen berhasil",Toast.LENGTH_LONG).show();
                        //Ke activity terima kasih
                            Intent intent = new Intent(mContext, ThanksActivity.class);
                            mContext.startActivity(intent);
                            finish();
                        //Kalau yang dimasukin salah
                    }else{
                        Log.d("data", String.valueOf(response.code()));
                        Toast.makeText(mContext,"Absen gagal",Toast.LENGTH_LONG).show();
                    }
                }else{
                    //Kalau user tidak ada
                    Log.d("data", String.valueOf(response.code()));
                    Toast.makeText(mContext,"Absen gagal",Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onFailure(Call<ResponseAbsen> call, Throwable t) {
                pDialog.hide();
                Log.d("data", t.toString());
                Toast.makeText(mContext,"Koneksi tidak ada", Toast.LENGTH_LONG).show();
                if (pDialog.isShowing())
                    pDialog.dismiss();
            }
        });
    }

    public void doAbsenPulang(){
        pDialog = new ProgressDialog(this);
        //  pDialog.getProgressHelper().setBarColor(Color.parseColor("#A5DC86"));
        pDialog.setMessage("Melakukan Absensi");
        pDialog.setCancelable(false);
        // pDialog.setIndeterminate(false);
        pDialog.show();
        int id = Prefs.getInt(user_pref.getIdUser(), 0);

        Call<ResponseAbsen> absen_pulang= client.getApi().pulang(id);
        absen_pulang.enqueue(new Callback<ResponseAbsen>() {
            @Override
            public void onResponse(Call<ResponseAbsen> call, Response<ResponseAbsen> response) {
                //Log.d("cek", "Kendal");
                pDialog.hide();
                //Kalau keisi semua
                if (response.isSuccessful()){
                    if (response.body().getStatus()){
                        data_absen = response.body().getData();
                        //Kalau absen berhasil
                        Toast.makeText(mContext,"Absen berhasil",Toast.LENGTH_LONG).show();
                        //Ke activity terima kasih
                        Intent intent = new Intent(mContext, ThanksPulangActivity.class);
                        mContext.startActivity(intent);
                        finish();
                        //Kalau yang dimasukin salah
                    }else{
                        Toast.makeText(mContext,"Absen gagal",Toast.LENGTH_LONG).show();
                    }
                }else{
                    //Kalau user tidak ada
                    Toast.makeText(mContext,"Absen gagal",Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onFailure(Call<ResponseAbsen> call, Throwable t) {
                pDialog.hide();
                Log.d("on failure", t.toString());
                Toast.makeText(mContext,"Koneksi tidak ada", Toast.LENGTH_LONG).show();
                if (pDialog.isShowing())
                    pDialog.dismiss();
            }
        });
    }

    public void logout(){
        Prefs.clear();
        Intent intent = new Intent(mContext, LoginActivity.class);
        mContext.startActivity(intent);
    }

}
