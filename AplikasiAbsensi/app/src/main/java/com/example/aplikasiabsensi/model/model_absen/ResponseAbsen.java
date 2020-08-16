package com.example.aplikasiabsensi.model.model_absen;

import com.example.aplikasiabsensi.model.model_user.DataUser;
import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ResponseAbsen {
    @SerializedName("status")
    @Expose
    private Boolean status;
    @SerializedName("message")
    @Expose
    private String message;
    @SerializedName("data")
    @Expose
    private DataAbsen data = null;

    public Boolean getStatus() {
        return status;
    }

    public void setStatus(Boolean status) {
        this.status = status;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public DataAbsen getData() {
        return data;
    }

    public void setData(DataAbsen data) {
        this.data = data;
    }
}
