package com.rafli.si_boss;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import java.util.jar.Attributes;

public class MainActivity extends AppCompatActivity  {

    TextView etEmail, etName;
    SessionManager sessionManager;
    String email, name;
    Button BtnKeluar,BtnAkunSaya,BtnPemesanan,BtnPembayaran;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        sessionManager = new SessionManager(MainActivity.this);
        if(!sessionManager.isLoggedIn()){
            moveToLogin();
        }

        etEmail = findViewById(R.id.etMainEmail);
        etName = findViewById(R.id.etMainName);

        BtnKeluar =findViewById(R.id.BtnKeluar);
        BtnAkunSaya = findViewById(R.id.BtnAkunSaya);
        BtnPemesanan = findViewById(R.id.BtnPemesanan);
        BtnPembayaran = findViewById(R.id.BtnPembayaran);

        email = sessionManager.getUserDetail().get(SessionManager.EMAIL_USER);
        name = sessionManager.getUserDetail().get(SessionManager.NAMA_USER);

        etEmail.setText(email);
        etName.setText(name);

        BtnAkunSaya.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), UpdateActivity.class);
                startActivity(intent);
            }
        });

        BtnKeluar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(MainActivity.this, LoginActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NO_HISTORY);
                startActivity(intent);
                sessionManager.logoutSession();
                moveToLogin();
            }
        });

        BtnPemesanan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), order_activity.class);
                startActivity(intent);
            }
        });

        BtnPembayaran.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), PaymentFormActivity.class);
                startActivity(intent);
            }
        });
    }

    private void moveToLogin() {
        Intent intent = new Intent(MainActivity.this, LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NO_HISTORY);
        startActivity(intent);
        finish();
    }

//Actions Log out
//    @Override
//    public boolean onCreateOptionsMenu(Menu menu) {
//        getMenuInflater().inflate(R.menu.menu, menu);
//        return super.onCreateOptionsMenu(menu);
//    }
//
//    @Override
//    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
//        switch (item.getItemId()){
//            case R.id.actionLogout:
//                sessionManager.logoutSession();
//                moveToLogin();
//        }
//        return super.onOptionsItemSelected(item);
//
//
//    }
}