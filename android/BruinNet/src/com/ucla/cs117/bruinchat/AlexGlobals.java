package com.ucla.cs117.bruinchat;

import android.app.Application;

public class AlexGlobals extends Application {
	private String savedName;
	
	@Override
	public void onCreate(){
		savedName = "";
	}
	
	public String getSavedName(){
		return savedName;
	}
	
	public void setSavedName(String input){
		savedName = input;
	}
}
