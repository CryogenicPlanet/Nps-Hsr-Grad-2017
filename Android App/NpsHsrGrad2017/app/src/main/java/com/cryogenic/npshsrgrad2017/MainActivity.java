package com.cryogenic.npshsrgrad2017;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.support.annotation.Nullable;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import com.google.zxing.Result;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.security.Permission;
import java.util.HashMap;
import java.util.Map;
import java.io.UnsupportedEncodingException;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.util.Objects;
import java.util.jar.Manifest;

import me.dm7.barcodescanner.zxing.ZXingScannerView;


public class MainActivity extends AppCompatActivity implements ZXingScannerView.ResultHandler {
    private ZXingScannerView mScannerview;

    protected RequestQueue MyRequestQueue;
    public String code;
    public String firstName;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        MyRequestQueue = Volley.newRequestQueue(this);
        final Object xyz = this;
        final AlertDialog.Builder builder = new AlertDialog.Builder(this);
        Button button = (Button) findViewById(R.id.button);
        Button conChecker = (Button) findViewById(R.id.conChecker);
        MyRequestQueue.start();
        //checkConnection();
        button.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                EditText password = (EditText) findViewById(R.id.editText);
                Log.i("Password", password.getText().toString());
                if (password.getText().toString().equals("sherlocked")) {
                    mScannerview = new ZXingScannerView((Context) xyz);
                    setContentView(mScannerview);
                    mScannerview.setResultHandler((ZXingScannerView.ResultHandler) xyz);
                    mScannerview.startCamera();

                } else {

                    builder.setTitle("Invalid Password");
                    builder.setMessage("Sorry You Have Typed An Invalid password and can't check someone in.");
                    AlertDialog alertDialog = builder.create();
                    alertDialog.show();
                }
            }
        });
        try {
            Thread.sleep(1000);
        } catch (InterruptedException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }

       /* conChecker.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                checkConnection();
            }
        }); */
        try {
            Thread.sleep(1000);
        } catch (InterruptedException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }
    }



    @Override
    protected void onPause() {
        super.onPause();
        try {
            mScannerview.stopCamera();
            MyRequestQueue.stop();
        } catch (Exception e){
            e.printStackTrace();
        }
    }

    @Override
    protected void onResume() {
        super.onResume();
     //   mScannerview.resumeCameraPreview(this);
    }


    public void handleResult(Result result) {
        // post to php
     final  AlertDialog.Builder builder = new AlertDialog.Builder(this);
      // final Object xyz = this;
        try {
            String text = result.getText();
            int postAuth = text.indexOf("Code") + 8;
            String authCode = text.substring(postAuth, postAuth + 10);
            Log.w("handleResult", result.getText());
            Log.w("authcode",authCode);
            int nameStr = text.indexOf("for") + 6;
              int nameEnd = text.indexOf(".This");
             firstName = text.substring(nameStr,nameEnd);



                String url = "https://npshsrgrad2017-cryogenicplanet.c9users.io/checkin.php";
                code = authCode;
                Log.w("Code",code);
                StringRequest MyStringRequest = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Log.i("Response",response);
                        //String value = intent.getStringExtra("response");
                        Log.i("Value From Sucess", response);
                        String title,msg;
                       /* if(response.equals("sucess")){
                            title = "Sucess";
                            msg ="The check in of : "+ firstName + " was sucessful.";
                        } else {
                            title = "Failure";
                            msg = response;
                        } */
                        title = "Response";
                        msg = firstName + " : " + response;
                        builder.setTitle(title);
                        builder.setMessage(msg);
                        AlertDialog alertDialog = builder.create();
                        alertDialog.setButton("OK", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {
                                // Write your code here to execute after dialog closed
                                resume();
                            }
                        });

                        alertDialog.show();
                        response = "xyz";
                        Log.w("xyz",response);

                    }
                }, new Response.ErrorListener() { //Create an error listener to handle errors appropriately.
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        //This code is executed if there is an error.
                    }
                }) {
                    protected Map<String, String> getParams() {
                        Map<String, String> MyData = new HashMap<String, String>();
                        MyData.put("authcode",code);
                        MyData.put("password","7f7d47f1ff6bf26a221b21ae3bde1074"); //Add the data you'd like to send to the server.
                        return MyData;
                    }
                };
            MyRequestQueue.add(MyStringRequest);





        } catch (StringIndexOutOfBoundsException ex) {
            Log.e("Index Out of Bounds",ex.toString());
        } catch (Exception ex){
            builder.setTitle("Fatal Error");
            builder.setMessage("A Fatal Error has occured the error is :" + ex.getMessage() +"Most likely you have used an invalid qr code without an authentication code or name.  ");
            AlertDialog alertDialog = builder.create();
            alertDialog.show();
            Log.e("Fatal Error",ex.toString());

        }
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }
public void resume(){
    mScannerview.resumeCameraPreview(this);
  //  this.onCreate(null);
}
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
   /* public void checkConnection(){
       final AlertDialog.Builder builder = new AlertDialog.Builder(this);
        String url = "https://npshsrgrad2017-cryogenicplanet.c9users.io/checkin.php";
        code = "conCheck";
      final  Button button = (Button) findViewById(R.id.button);
        final EditText pass = (EditText) findViewById(R.id.editText);

        StringRequest MyStringRequest = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.i("Response",response);

                String value = response;
                if(value.equals("true")){
                    builder.setTitle("Server ON");
                    builder.setMessage("Server is On and Connection Was Sucessful.");
                    AlertDialog alertDialog = builder.create();
                    button.setEnabled(true);
                    pass.setEnabled(true);
                    alertDialog.show();
                }else{
                    builder.setTitle("Server OFF");
                    builder.setMessage("Server is OFF and Connection Was UnSucessful. Contact Rahul Tarak.");
                    AlertDialog alertDialog = builder.create();
                    button.setEnabled(false);
                    pass.setEnabled(false);
                    alertDialog.show();
                }
                //This code is executed if the server responds, whether or not the response contains data.
                //The String 'response' contains the server's response.

            }
        }, new Response.ErrorListener() { //Create an error listener to handle errors appropriately.
            @Override
            public void onErrorResponse(VolleyError error) {
                builder.setTitle("Server OFF");
                builder.setMessage("Server is OFF and Connection Was Unsucessful. Contact Rahul Tarak.");
                AlertDialog alertDialog = builder.create();
                button.setEnabled(false);
                pass.setEnabled(false);
                alertDialog.show();
            }
        }) {
            protected Map<String, String> getParams() {
                Map<String, String> MyData = new HashMap<String, String>();
                MyData.put("authcode",code);
                MyData.put("password","7f7d47f1ff6bf26a221b21ae3bde1074");//Add the data you'd like to send to the server.
                return MyData;
            }
        };


        MyRequestQueue.add(MyStringRequest);
    } */
}
