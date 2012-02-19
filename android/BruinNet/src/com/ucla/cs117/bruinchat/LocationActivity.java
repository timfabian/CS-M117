package com.ucla.cs117.bruinchat;

import android.app.Activity;
import android.content.Context;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.widget.TextView;

public class LocationActivity extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.location_activity);
		
		// Acquire a reference to the system Location Manager
		LocationManager locationManager = (LocationManager) this.getSystemService(Context.LOCATION_SERVICE);

		// Define a listener that responds to location updates
		LocationListener locationListener = new LocationListener() {
		    public void onLocationChanged(Location location) {
		      // Called when a new location is found by the network location provider.
		      makeUseOfNewLocation(location);
		    }

		    public void onStatusChanged(String provider, int status, Bundle extras) {}

		    public void onProviderEnabled(String provider) {}

		    public void onProviderDisabled(String provider) {}
		  };

		// Register the listener with the Location Manager to receive location updates
		if (locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER))	{
			locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0, 0, locationListener);
			TextView loc_m = (TextView) findViewById(R.id.location_message);
			loc_m.setText("Your location is approximately:");
		}
		else	{
			TextView loc_m = (TextView) findViewById(R.id.location_message);
			loc_m.setText("Location provider is diabled");
		}
		
		//Location lastKnownLocation = locationManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
	}
	
	private void makeUseOfNewLocation(Location location)	{
		double lat = location.getLatitude();
		double lon = location.getLongitude();
		
		TextView loc_lat = (TextView) findViewById(R.id.location_lat);
		TextView loc_lon = (TextView) findViewById(R.id.location_lon);
		
		String lat_coord = Double.toString(lat);
		String lon_coord = Double.toString(lon);
		
		loc_lat.setText("Latitude: " + lat_coord);
		loc_lon.setText("Longitude: " + lon_coord);
		
	}

}
