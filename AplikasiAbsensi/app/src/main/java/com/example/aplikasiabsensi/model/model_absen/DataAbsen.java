package com.example.aplikasiabsensi.model.model_absen;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class DataAbsen {
    @SerializedName("id_absen")
    @Expose
    private Integer id_absen;

    @SerializedName("id_user")
    @Expose
    private Integer id_user;

    @SerializedName("tanggal")
    @Expose
    private String tanggal;

    @SerializedName("jam")
    @Expose
    private String jam;

    @SerializedName("keterangan")
    @Expose
    private String keterangan;

    //Mendapatkan ID Absen
    public Integer getId_absen() {
        return id_absen;
    }

    //Mengganti ID Absen
    public void setId_absen(Integer id_absen) {
        this.id_absen = id_absen;
    }

    //Menampilkan ID User
    public Integer getId_user() {
        return id_user;
    }

    //Mengganti ID User
    public void setId_user(Integer id_user) {
        this.id_user = id_user;
    }

    //Menampilkan tanggal
    public String getDate() {
        return tanggal;
    }

    //Mengganti tanggal
    public void setDate(String tanggal) {
        this.tanggal = tanggal;
    }

    //Menampilkan jam
    public String getJam() {
        return jam;
    }

    //Mengganti jam
    public void setJam(String jam) {
        this.jam = jam;
    }

    //Melihat keterangan
    public String getKeterangan() {
        return keterangan;
    }

    //Mengganti keterangan
    public void setKeterangan(String keterangan) { this.keterangan = keterangan; }
}
