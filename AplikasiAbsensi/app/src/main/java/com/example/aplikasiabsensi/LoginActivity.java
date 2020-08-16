package com.example.aplikasiabsensi;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.aplikasiabsensi.model.model_user.ResponseLogin;
import com.example.aplikasiabsensi.preference.user_pref;
import com.example.aplikasiabsensi.interfaces.InitComponent;
import com.example.aplikasiabsensi.api.client;

import com.example.aplikasiabsensi.model.model_user.DataUser;
import com.pixplicity.easyprefs.library.Prefs;

import org.json.JSONArray;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginActivity extends AppCompatActivity implements InitComponent, View.OnClickListener {

    private EditText username, password;
    private Button login_button;
    //Declare context
    private Context mContext;
    //Declare the data of the user
    private DataUser userData;

    //Declare progress dialog
    private ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        startInit();
        mContext=this;
        //Login Variable
        username = findViewById(R.id.username);
        password = findViewById(R.id.password);
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
    public void initUI() {
        username=findViewById(R.id.username);
        password=findViewById(R.id.password);
        login_button=findViewById(R.id.button);
    }

    @Override
    public void initValue() {
        //Only do from the parent class
    }

    @Override
    public void initEvent() {
        login_button.setOnClickListener(this);
    }

    @Override
    public void onClick(View view) {
        if (validate_login()) login();
    }

    public boolean validate_login(){
        return !cek(username) && !cek(password);
    }

    public void login(){
        pDialog = new ProgressDialog(this);
        //  pDialog.getProgressHelper().setBarColor(Color.parseColor("#A5DC86"));
        pDialog.setMessage("Loading");
        pDialog.setCancelable(false);
        // pDialog.setIndeterminate(false);
        pDialog.show();

        Call<ResponseLogin> user= client.getApi().auth(username.getText().toString(),password.getText().toString());
        user.enqueue(new Callback<ResponseLogin>() {
            @Override
            public void onResponse(Call<ResponseLogin> call, Response<ResponseLogin> response) {
                pDialog.hide();
                if (response.isSuccessful()){
                    if (response.body().getStatus()){
                        userData=response.body().getData();
                        //Kalau login berhasil
                        Toast.makeText(mContext,"Login berhasil",Toast.LENGTH_LONG).show();
                        Log.d("data user",userData.toString());
                        setPreference(userData);
                        if (userData.getRole().equals("siswa")) {
                            Intent intent = new Intent(mContext, HomeActivity.class);
                            mContext.startActivity(intent);
                            finish();
                        } else {
                            Toast.makeText(mContext, "Aplikasi ini diperuntukkan untuk siswa, silahkan gunakan web admin", Toast.LENGTH_LONG).show();
                        }
                        //Kalau yang dimasukin salah
                    }else{
                        Toast.makeText(mContext,"Username dan password salah",Toast.LENGTH_LONG).show();
                    }
                }else{
                    //Kalau user tidak ada
                    Toast.makeText(mContext,"Username dan password salah",Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onFailure(Call<ResponseLogin> call, Throwable t) {
                pDialog.hide();
                Log.d("fail", t.toString());
                Toast.makeText(mContext,"Koneksi Tidak ada", Toast.LENGTH_LONG).show();

                if (pDialog.isShowing())
                    pDialog.dismiss();
            }
        });
    }

    private void setPreference(DataUser du){
        Prefs.putInt(user_pref.getIdUser(), du.getId_user());
        Prefs.putString(user_pref.getUsername(), du.getUsername());
        Prefs.putString(user_pref.getPassword(), du.getPassword());
        Prefs.putString(user_pref.getRole(), du.getRole());
    }

    public static boolean cek(EditText et) {
            View focusView = null;
            Boolean cancel=false;
            //Kalau ada yang belum diisi
            if (TextUtils.isEmpty(et.getText().toString().trim())) {
                et.setError("Harus Di Isi");
                focusView = et;
                cancel = true;
            }
            //Kalau udah diisi semua
            if (cancel) {
                focusView.requestFocus();
            }
            return cancel;
        }

}
