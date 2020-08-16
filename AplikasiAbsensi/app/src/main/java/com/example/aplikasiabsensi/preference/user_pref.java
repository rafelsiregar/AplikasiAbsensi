package com.example.aplikasiabsensi.preference;

public class user_pref {
        private static String id_user="id_user";
        private static String username="username";
        private static String password="password";
        private static String role="role";

        public static String getPassword() {
            return password;
        }

        public static void setPassword(String password) {
            user_pref.password = password;
        }

        public static String getIdUser() {
            return id_user;
        }

        public static String getUsername() {
            return username;
        }

        public static String getRole() { return role; }
    }
