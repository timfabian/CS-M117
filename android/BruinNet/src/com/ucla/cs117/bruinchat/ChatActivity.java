package com.ucla.cs117.bruinchat;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.TextView;

public class ChatActivity extends Activity {
	@Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main2);

		AlexGlobals alexState = ((AlexGlobals)getApplicationContext());
        final TextView welcome = (TextView) findViewById(R.id.textView2);
        welcome.setText("Welcome to BruinChat, " + alexState.getSavedName() + "!");
	    final Button exitButton = (Button) findViewById(R.id.button2);
	    final Button locationButton = (Button) findViewById(R.id.button3);
	    
	    locationButton.setOnClickListener(new OnClickListener() {
			
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Intent i = new Intent(ChatActivity.this, LocationActivity.class);
				startActivity(i);
			}
		});
        
	}
}
