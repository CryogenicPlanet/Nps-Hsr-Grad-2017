package com.cryogenic.npshsrgrad2017;

import android.app.AlertDialog;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class Sucess extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sucess);
        try{
            Button button = (Button) findViewById(R.id.button2);

            button.setOnClickListener(new View.OnClickListener() {
                public void onClick(View v) {
                    Intent myIntent = new Intent(Sucess.this, MainActivity.class);
                    Sucess.this.startActivity(myIntent);
                }
            });
            TextView t=(TextView)findViewById(R.id.textView);
            Intent intent = getIntent();
            AlertDialog.Builder builder = new AlertDialog.Builder(this);
            try {
                Thread.sleep(1000);

                String value = intent.getStringExtra("response");
                Log.i("Value From Sucess", value);
                String title,msg;
                if(value.equals("sucess")){
                    title = "Sucess";
                    msg ="The check in was sucessful.";
                } else {
                    title = "Failure";
                    msg = value;
                }
                builder.setTitle(title);
                builder.setMessage(msg);
                AlertDialog alertDialog = builder.create();
                alertDialog.show();
            } catch (InterruptedException e) {
                // TODO Auto-generated catch block
                e.printStackTrace();
            }

        } catch (Exception e){
            e.printStackTrace();
        }}


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_sucess, menu);
        return true;
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
}
