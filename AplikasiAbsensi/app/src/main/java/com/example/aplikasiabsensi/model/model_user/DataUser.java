package com.example.aplikasiabsensi.model.model_user;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class DataUser {
    @SerializedName("id_user")
    @Expose
    private Integer id_user;

    @SerializedName("username")
    @Expose
    private String username;

    @SerializedName("password")
    @Expose
    private String password;

    @SerializedName("role")
    @Expose
    private String role;

        public Integer getId_user() {
            return id_user;
        }

        public void setId_user(Integer id_user) {
            this.id_user = id_user;
        }

        //Username
        public String getUsername() {
            return username;
        }
        //Mengganti username
        public void setUsername(String username) {
            this.username = username;
        }

        //Password
        public String getPassword() {
            return password;
        }

        //Mengganti password
        public void setPassword(String password) {
            this.password = password;
        }

        //Melihat role
        public String getRole() {
            return role;
        }

        //Mengganti role
        public void setRole(String role) { this.role = role; }

    }
