package com.example.aplikasiabsensi.model.model_jam;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class DataJam {
    @SerializedName("id_jam")
    @Expose
    private Integer id_jam;

    @SerializedName("mulai")
    @Expose
    private String mulai;

    @SerializedName("selesai")
    @Expose
    private String selesai;

    @SerializedName("keterangan")
    @Expose
    private String keterangan;

    public Integer getId_jam() {
        return id_jam;
    }

    public void setId_jam(Integer id_jam) {
        this.id_jam = id_jam;
    }

    public String getMulai() {
        return mulai;
    }

    public void setMulai(String username) {
        this.mulai = mulai;
    }

    public String getSelesai() {
        return selesai;
    }

    public void setSelesai(String selesai) {
        this.selesai = selesai;
    }

    public String getKeterangan() {
        return keterangan;
    }

    public void setKeterangan(String keterangan) { this.keterangan = keterangan; }

}
