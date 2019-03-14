package com.naveen.project.tms.idol;


import android.Manifest;
import android.app.Dialog;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.support.design.widget.Snackbar;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v4.content.LocalBroadcastManager;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.InputType;
import android.text.method.HideReturnsTransformationMethod;
import android.text.method.PasswordTransformationMethod;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.naveen.project.tms.idol.receiver.NetworkStateChangeReceiver;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import static com.naveen.project.tms.idol.receiver.NetworkStateChangeReceiver.IS_NETWORK_AVAILABLE;

public class LoginActivity extends AppCompatActivity {

    EditText UserId, PasswordEt;
    String userId, password, type;

    // Session Manager Class
    SessionManager session;

    private static CheckBox show_hide_password;

    String TAG = "Permissions";

    TextView forgot_password;
    Dialog myDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        UserId = findViewById(R.id.etUserId);
        PasswordEt = findViewById(R.id.etPwd);
        forgot_password = findViewById(R.id.forgot_password);
        myDialog = new Dialog(this);
        if(checkAndRequestPermissions()) {
            // carry on the normal flow, as the case of  permissions  granted.

            IntentFilter intentFilter = new IntentFilter(NetworkStateChangeReceiver.NETWORK_AVAILABLE_ACTION);
            LocalBroadcastManager.getInstance(this).registerReceiver(new BroadcastReceiver() {
                @Override
                public void onReceive(Context context, Intent intent) {
                    boolean isNetworkAvailable = intent.getBooleanExtra(IS_NETWORK_AVAILABLE, false);
                    String networkStatus = isNetworkAvailable ? "connected" : "disconnected";

                    Snackbar.make(findViewById(R.id.LoginActivity), "Network Status: " + networkStatus, Snackbar.LENGTH_LONG).show();
                }
            }, intentFilter);

            boolean connected = false;
            ConnectivityManager connectivityManager = (ConnectivityManager)getSystemService(Context.CONNECTIVITY_SERVICE);
            if(connectivityManager.getNetworkInfo(ConnectivityManager.TYPE_MOBILE).getState() == NetworkInfo.State.CONNECTED ||
                    connectivityManager.getNetworkInfo(ConnectivityManager.TYPE_WIFI).getState() == NetworkInfo.State.CONNECTED) {
                //we are connected to a network
                connected = true;
            }
            else
                connected = false;

            if(connected == false)
            {
                Intent intent = new Intent(LoginActivity.this,Internet_Connection.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK|Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);

                finish();
            }
            // Session Manager
            session = new SessionManager(getApplicationContext());
            //Toast.makeText(getApplicationContext(), "User Login Status: " + session.isLoggedIn(), Toast.LENGTH_LONG).show();
            if (session.isLoggedIn()==true){
                Intent intent = new Intent(LoginActivity.this,MainActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK|Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);
            }

            show_hide_password = (CheckBox) findViewById(R.id.show_hide_password);
            show_hide_password
                    .setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {

                        @Override
                        public void onCheckedChanged(CompoundButton button,
                                                     boolean isChecked) {

                            // If it is checkec then show password else hide
                            // password
                            if (isChecked) {

                                show_hide_password.setText(R.string.hide_pwd);// change
                                // checkbox
                                // text

                                PasswordEt.setInputType(InputType.TYPE_CLASS_TEXT);
                                PasswordEt.setTransformationMethod(HideReturnsTransformationMethod
                                        .getInstance());// show password
                            } else {
                                show_hide_password.setText(R.string.show_pwd);// change
                                // checkbox
                                // text

                                PasswordEt.setInputType(InputType.TYPE_CLASS_TEXT
                                        | InputType.TYPE_TEXT_VARIATION_PASSWORD);
                                PasswordEt.setTransformationMethod(PasswordTransformationMethod
                                        .getInstance());// hide password

                            }

                        }
                    });

            forgot_password.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    ShowForgotPasswordPopup(R.layout.forgot_password_popup);
                }
            });

        }

    }
    public void ShowForgotPasswordPopup(int view) {
        TextView txtclose;
        myDialog.setContentView(view);
        txtclose =(TextView) myDialog.findViewById(R.id.txtclose);
        txtclose.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                myDialog.dismiss();
            }
        });
        myDialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        final EditText etGmail,etUserId;

        Button btnConfirm;

        etGmail =(EditText) myDialog.findViewById(R.id.etGmail);
        etUserId =(EditText) myDialog.findViewById(R.id.etUserId);
        btnConfirm =(Button) myDialog.findViewById(R.id.btnConfirm);

     
        btnConfirm.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String Gmail;
                Gmail = etGmail.getText().toString();
                userId = etUserId.getText().toString();

                if(Gmail.trim().length()>0 ){
                    type = "gmail";
                    BackgroundWorker backgroundWorker = new BackgroundWorker();
                    backgroundWorker.execute(Gmail);
                }
                else{
                    Toast.makeText(getApplicationContext(),"Enter the Email id",Toast.LENGTH_LONG).show();
                }

            }
        });

        myDialog.show();

    }
    public void OnLogin(View view) {

        userId = UserId.getText().toString();
        password = PasswordEt.getText().toString();
        if(userId.trim().length()>0 && password.trim().length()>0){
            type = "login";
            BackgroundWorker backgroundWorker = new BackgroundWorker();
            backgroundWorker.execute();
        }else{
            String f="Please enter username and password";
            Toast.makeText(LoginActivity.this,f ,Toast.LENGTH_LONG ).show();
        }
    }

    public class BackgroundWorker extends AsyncTask<String,Void,String> {

        android.app.AlertDialog alertDialog;

        @Override
        protected String doInBackground(String... params) {



            try {
                String post_data = null;
                String login_url = null;

                if(type.equals("login")) {
                    //login_url = "https://ulixsoftware.com/idolsoftware/model/IDOL/login.php";
                    login_url = SessionManager.IP+"idolsoftware/model/IDOL/login.php";
                    //login_url = "http://arulaudios.com/IDOL/login.php";
                    post_data = URLEncoder.encode("uid","UTF-8")+"="+ URLEncoder.encode(userId,"UTF-8")+"&"
                            + URLEncoder.encode("passwd","UTF-8")+"="+ URLEncoder.encode(password,"UTF-8");
                }else if(type.equals("gmail")) {
                    String gmail;
                    gmail = params[0];
                    //login_url = "https://ulixsoftware.com/idolsoftware/model/IDOL/forgotPassword.php";
                    login_url = SessionManager.IP+"idolsoftware/model/IDOL/forgotPassword.php";
                    //login_url = "http://arulaudios.com/IDOL/forgotPassword.php";
                    post_data = URLEncoder.encode("user_id","UTF-8")+"="+ URLEncoder.encode(userId,"UTF-8")+"&"
                            + URLEncoder.encode("gmail","UTF-8")+"="+ URLEncoder.encode(gmail,"UTF-8");
                }

                URL url = new URL(login_url);
                HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoOutput(true);
                httpURLConnection.setDoInput(true);
                OutputStream outputStream = httpURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));

                bufferedWriter.write(post_data);
                bufferedWriter.flush();
                bufferedWriter.close();
                outputStream.close();
                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream,"iso-8859-1"));
                String result="";
                String line="";
                while((line = bufferedReader.readLine())!= null) {
                    result += line;
                }
                bufferedReader.close();
                inputStream.close();
                httpURLConnection.disconnect();

                return result;

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }




            return null;
        }

        @Override
        protected void onPreExecute() {

        }

        @Override
        protected void onPostExecute(String result) {

            String f = result;
            Log.w("Login", result);
            final android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(LoginActivity.this);
            if(type.equals("login")){

                //builder.setTitle("Login Status");

                if(userId.trim().length() > 0 && password.trim().length() > 0){

                    if(result.charAt(0)=='L')
                    {
                  //      f ="Login Success! Welcome!!!";

                        SessionManager session;
                        session = new SessionManager(LoginActivity.this);
                        session.createLoginSession(userId,password);

                        Intent intent = new Intent(LoginActivity.this,SplashActivity.class);
                        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK|Intent.FLAG_ACTIVITY_CLEAR_TASK);
                        Bundle extras = new Bundle();
                        extras.putString("userId",userId);
                        intent.putExtras(extras);
                        startActivity(intent);

                        Toast.makeText(LoginActivity.this,"You have successfully logged in" ,Toast.LENGTH_LONG ).show();
                        /*
                        builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {

                                Intent intent = new Intent(LoginActivity.this,SplashActivity.class);
                                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK|Intent.FLAG_ACTIVITY_CLEAR_TASK);
                                Bundle extras = new Bundle();
                                extras.putString("userId",userId);
                                intent.putExtras(extras);
                                startActivity(intent);

                            }
                        });
                        */
                    }else if(result.charAt(0)=='Y'){
                        Toast.makeText(LoginActivity.this,"You are already logged in other device" ,Toast.LENGTH_LONG ).show();
                    }
                    else {
                        Toast.makeText(LoginActivity.this,"User Id or Password is Incorrect" ,Toast.LENGTH_LONG ).show();
                        /*
                        f = "User Id or Password is Incorrect";
                        builder.setNeutralButton("Try Again", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                android.support.v7.app.AlertDialog alert1 = builder.create();
                                alert1.cancel();
                            }
                        });
                        */
                    }

                }
                else{
                    // user didn't entered username or password
                    // Show alert asking him to enter the details
                    f="Please enter username and password";
                    Toast.makeText(LoginActivity.this,f ,Toast.LENGTH_LONG ).show();
                    /*
                    builder.setNeutralButton("Try Again", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            android.support.v7.app.AlertDialog alert1 = builder.create();
                            alert1.cancel();
                        }
                    });
                    */
                }

            }else if(type.equals("gmail")) {
                if(result.charAt(0)=='c'){
                    f = "Your password is sent to your mail";
                    builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            android.support.v7.app.AlertDialog alert1 = builder.create();
                            alert1.cancel();
                            myDialog.cancel();
                        }
                    });
                }else if (result.charAt(0)=='w'){
                    f = "Your mail id is incorrect";
                    builder.setNeutralButton("Try Again", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            android.support.v7.app.AlertDialog alert1 = builder.create();
                            alert1.cancel();
                        }
                    });
                }
                builder.setMessage(f);
                android.support.v7.app.AlertDialog alert1 = builder.create();
                alert1.show();
                // To close the AlertDialog
                // alert1.cancel();
            }

        }


    }

    private void showDialogOK(String message, DialogInterface.OnClickListener okListener) {
        new AlertDialog.Builder(this)
                .setMessage(message)
                .setPositiveButton("OK", okListener)
                .setNegativeButton("Cancel", okListener)
                .create()
                .show();
    }
    public static final int REQUEST_ID_MULTIPLE_PERMISSIONS = 1;

    private  boolean checkAndRequestPermissions() {
        int camera = ContextCompat.checkSelfPermission(this, android.Manifest.permission.CAMERA);
        int storage = ContextCompat.checkSelfPermission(this, android.Manifest.permission.WRITE_EXTERNAL_STORAGE);
        int loc = ContextCompat.checkSelfPermission(this, android.Manifest.permission.ACCESS_COARSE_LOCATION);
        int loc2 = ContextCompat.checkSelfPermission(this, android.Manifest.permission.ACCESS_FINE_LOCATION);
        int storage2= ContextCompat.checkSelfPermission(this, Manifest.permission.READ_EXTERNAL_STORAGE);
        List<String> listPermissionsNeeded = new ArrayList<>();

        if (camera != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(android.Manifest.permission.CAMERA);
        }
        if (storage != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(android.Manifest.permission.WRITE_EXTERNAL_STORAGE);
        }
        if (loc2 != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(android.Manifest.permission.ACCESS_FINE_LOCATION);
        }
        if (loc != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(android.Manifest.permission.ACCESS_COARSE_LOCATION);
        }
        if (storage2 != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(Manifest.permission.READ_EXTERNAL_STORAGE);
        }
        if (!listPermissionsNeeded.isEmpty())
        {
            ActivityCompat.requestPermissions(this,listPermissionsNeeded.toArray
                    (new String[listPermissionsNeeded.size()]),REQUEST_ID_MULTIPLE_PERMISSIONS);
            return false;
        }
        return true;
    }

    @Override
    public void onRequestPermissionsResult(int requestCode,
                                           String permissions[], int[] grantResults) {
        Log.w(TAG, "Permission callback called-------");
        switch (requestCode) {
            case REQUEST_ID_MULTIPLE_PERMISSIONS: {
                Map<String, Integer> perms = new HashMap<>();
                // Initialize the map with both permissions
                perms.put(Manifest.permission.ACCESS_COARSE_LOCATION, PackageManager.PERMISSION_GRANTED);
                perms.put(Manifest.permission.ACCESS_FINE_LOCATION, PackageManager.PERMISSION_GRANTED);
                perms.put(Manifest.permission.READ_EXTERNAL_STORAGE, PackageManager.PERMISSION_GRANTED);
                perms.put(Manifest.permission.WRITE_EXTERNAL_STORAGE, PackageManager.PERMISSION_GRANTED);
                perms.put(Manifest.permission.CAMERA, PackageManager.PERMISSION_GRANTED);
                // Fill with actual results from user
                if (grantResults.length > 0) {
                    for (int i = 0; i < permissions.length; i++)
                        perms.put(permissions[i], grantResults[i]);
                    // Check for both permissions
                    if (perms.get(Manifest.permission.ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED
                            && perms.get(Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED
                            &&perms.get(Manifest.permission.READ_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED
                            && perms.get(Manifest.permission.WRITE_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED
                            &&perms.get(Manifest.permission.CAMERA) == PackageManager.PERMISSION_GRANTED) {
                        Log.w(TAG, "All permissions are granted");
                        // process the normal flow
                        //else any one or both the permissions are not granted
                    } else {
                        Log.w(TAG, "Some permissions are not granted ask again ");
                        //permission is denied (this is the first time, when "never ask again" is not checked) so ask again explaining the usage of permission
//                        // shouldShowRequestPermissionRationale will return true
                        //show the dialog or snackbar saying its necessary and try again otherwise proceed with setup.
                        if (ActivityCompat.shouldShowRequestPermissionRationale(this, Manifest.permission.ACCESS_COARSE_LOCATION)
                                || ActivityCompat.shouldShowRequestPermissionRationale(this, Manifest.permission.ACCESS_FINE_LOCATION)
                                || ActivityCompat.shouldShowRequestPermissionRationale(this, Manifest.permission.READ_EXTERNAL_STORAGE)
                                || ActivityCompat.shouldShowRequestPermissionRationale(this, Manifest.permission.WRITE_EXTERNAL_STORAGE)
                                || ActivityCompat.shouldShowRequestPermissionRationale(this, Manifest.permission.CAMERA)
                                ) {
                            showDialogOK("Storage, Camera and Location Services Permission required for this app",
                                    new DialogInterface.OnClickListener() {
                                        @Override
                                        public void onClick(DialogInterface dialog, int which) {
                                            switch (which) {
                                                case DialogInterface.BUTTON_POSITIVE:
                                                    checkAndRequestPermissions();
                                                    break;
                                                case DialogInterface.BUTTON_NEGATIVE:
                                                    // proceed with logic by disabling the related features or quit the app.
                                                    break;
                                            }
                                        }
                                    });
                        }
                        //permission is denied (and never ask again is  checked)
                        //shouldShowRequestPermissionRationale will return false
                        else {
                            Toast.makeText(this, "Go to settings and enable permissions", Toast.LENGTH_LONG)
                                    .show();
                            //                            //proceed with logic by disabling the related features or quit the app.
                        }
                    }
                }
            }
        }

    }
}