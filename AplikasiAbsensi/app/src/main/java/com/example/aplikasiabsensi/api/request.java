package com.example.aplikasiabsensi.api;

import android.util.Log;

import com.example.aplikasiabsensi.model.model_absen.ResponseAbsen;
import com.example.aplikasiabsensi.model.model_user.ResponseLogin;

import org.json.JSONStringer;

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.DELETE;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Part;
import retrofit2.http.Path;


public interface request {
    @FormUrlEncoded
    @POST("Api/login")
    Call<ResponseLogin> auth(@Field("username") String username,
                             @Field("password") String password);

    @FormUrlEncoded
    @POST("Api/absen/masuk")
    Call<ResponseAbsen> masuk(@Field("id_user") int id_user);

    @FormUrlEncoded
    @POST("Api/absen/pulang")
    Call<ResponseAbsen> pulang(@Field("id_user") int id_user);

}
