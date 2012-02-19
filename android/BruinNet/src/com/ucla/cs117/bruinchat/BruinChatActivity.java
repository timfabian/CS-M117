package com.ucla.cs117.bruinchat;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.ResponseHandler;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.BasicResponseHandler;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.os.NetworkOnMainThreadException;
import android.view.Gravity;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.inputmethod.InputMethodManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;


public class BruinChatActivity extends Activity {
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        
        final Button button = (Button) findViewById(R.id.button1);
        final EditText username = (EditText) findViewById(R.id.nickname);
        final Context context = this;
        
        button.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
            	
            	if ( username.getText().toString().isEmpty() == true )
            	{
            		Toast toast = Toast.makeText(BruinChatActivity.this, "Sorry, please enter a name!", Toast.LENGTH_LONG);
            		toast.setGravity(Gravity.CENTER_HORIZONTAL|Gravity.CENTER_VERTICAL, 0, 0);
            		toast.show();
            		hideSoftKeyboard(username);
            	}
            	else
            	{
            		HttpClient httpclient = new DefaultHttpClient();
            		HttpPost httppost = new HttpPost("http://cs-m117.samuelkarp.com/nickname/" + username.getText().toString() + "/register");
            		String response = "";
            		
            		try {
            			List<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>(1);
            			nameValuePairs.add(new BasicNameValuePair("device_id", "11"));
            			
            			httppost.setEntity(new UrlEncodedFormEntity(nameValuePairs));
            			
            			ResponseHandler<String> responseHandler = new BasicResponseHandler();
            			
            			response = httpclient.execute(httppost, responseHandler);

            	    } catch (ClientProtocolException e) {
            	    } catch (IOException e) {
            	    } catch (NetworkOnMainThreadException e)	{
            	    }

            		if ( response.contains("false") == true )
            		{
            			Toast toast = Toast.makeText(BruinChatActivity.this, "Sorry, the name \"" + username.getText().toString() + "\" is already taken!", Toast.LENGTH_LONG);
                		toast.setGravity(Gravity.CENTER_HORIZONTAL|Gravity.CENTER_VERTICAL, 0, 0);
                		toast.show();
            		}
            		else
            		{
            			AlexGlobals alexState = ((AlexGlobals)getApplicationContext());
            			alexState.setSavedName(username.getText().toString());
            			
        			    Intent intent = new Intent(context, ChatActivity.class);
                        startActivity(intent);
                        
            			//Toast toast = Toast.makeText(BruinChatActivity.this, "Welcome to BruinChat, " + username.getText().toString() + "!", Toast.LENGTH_LONG);
                		//toast.setGravity(Gravity.CENTER_HORIZONTAL|Gravity.CENTER_VERTICAL, 0, 0);
                		//toast.show();
            		}

            		username.setText("");
            		hideSoftKeyboard(username);
            	}
            }
        });
    }

    private void hideSoftKeyboard( EditText et ){
        if(getCurrentFocus()!=null && getCurrentFocus() instanceof EditText){
            InputMethodManager imm = (InputMethodManager)getSystemService(Context.INPUT_METHOD_SERVICE);
            imm.hideSoftInputFromWindow(et.getWindowToken(), 0);
        }
    }
}
