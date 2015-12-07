package wohoo.app.com.wohoo;

import android.app.ProgressDialog;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.mime.content.FileBody;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;

import java.io.File;
import java.io.IOException;

import wohoo.app.com.wohoo.request.AndroidMultiPartEntity;
import wohoo.app.com.wohoo.request.Constant;


public class UploadActivity extends ActionBarActivity {

    private ImageView imgUpload;
    private Button btnCancel;
    private Button btnUpload;
    long totalSize = 0;
    private String filePath;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_upload);

        imgUpload = (ImageView) findViewById(R.id.imgUpload);
        btnCancel = (Button) findViewById(R.id.btnCancel);
        btnUpload = (Button) findViewById(R.id.btnUpload);
        filePath = getIntent().getStringExtra("imgPath");


        Bitmap bmImg = BitmapFactory.decodeFile(filePath);
        imgUpload.setImageBitmap(bmImg);

        btnCancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                setResult(RESULT_CANCELED);
                finish();
            }
        });

        btnUpload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new UploadFileToServer().execute(filePath);
            }
        });

    }

    private class UploadFileToServer extends AsyncTask<String, Integer, String> {
        ProgressDialog pDialog;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(UploadActivity.this);
            pDialog.setMessage("Uploading....");
            pDialog.setCancelable(false);
            pDialog.show();
        }

        @Override
        protected String doInBackground(String... params) {
            return uploadFile(params[0]);
        }


        private String uploadFile(String filepath) {
            String responseString = null;

            HttpClient httpclient = new DefaultHttpClient();
            HttpPost httppost = new HttpPost(Constant.REQ_UPLOAD);

            try {
                AndroidMultiPartEntity entity = new AndroidMultiPartEntity(
                        new AndroidMultiPartEntity.ProgressListener() {

                            @Override
                            public void transferred(long num) {

                            }
                        });

                File sourceFile = new File(filepath);

                // Adding file data to http body
                entity.addPart("image", new FileBody(sourceFile));

                // Extra parameters if you want to pass to server
//                entity.addPart("website",
//                        new StringBody("www.androidhive.info"));
//                entity.addPart("email", new StringBody("abc@gmail.com"));

               // totalSize = entity.getContentLength();
                httppost.setEntity(entity);

                // Making server call
                HttpResponse response = httpclient.execute(httppost);
                HttpEntity r_entity = response.getEntity();

                int statusCode = response.getStatusLine().getStatusCode();
                if (statusCode == 200) {
                    // Server response
                    responseString = EntityUtils.toString(r_entity);
                } else {
                    responseString = "Error occurred! Http Status Code: "
                            + statusCode;
                }

            } catch (ClientProtocolException e) {
                responseString = e.toString();
            } catch (IOException e) {
                responseString = e.toString();
            }

            return responseString;

        }

        @Override
        protected void onPostExecute(String result) {
            Log.e("", "Response from server: " + result);
            pDialog.dismiss();
            Toast.makeText(UploadActivity.this,"File uploaded successfully.", Toast.LENGTH_LONG).show();
            setResult(RESULT_OK);
            finish();
            // showing the server response in an alert dialog
            // showAlert(result);
            super.onPostExecute(result);
        }

    }


}
