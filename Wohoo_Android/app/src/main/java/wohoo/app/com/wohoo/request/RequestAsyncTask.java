package wohoo.app.com.wohoo.request;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import java.io.BufferedReader;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.UnknownHostException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

public class RequestAsyncTask extends AsyncTask<String, Void, String> {
    private final String TAG = "RequestAsyncTask";
    private RequestCompleteListener<String> callback = null;
    private ProgressDialog progressDialog = null;

    private HttpClient httpClient;

    private HttpGet httpget;
    private HttpPost httpPost;
    private HttpResponse response;

    private String responseString = "";
    private String webserviceCb = "";
    private HashMap<String, Object> paramValues = null;

    public static final int REQUEST_METHOD_GET = 1;
    public static final int REQUEST_METHOD_POST = 2;

    public static final int CANCELED = 101;
    public static final int COMPLETED = 102;
    public static final int ERROR = 103;
    public static final int INTERNET = 104;

    public int status = ERROR;

    public boolean isMultiPartData = false;
    private static final String twoHyphens = "--";
    private static final String boundary = "---------------------------";
    private static final String CRLF = "\r\n";
    private ConnectionDetector checkConnection;
    private Boolean isNetAvailable = false;
    public static Boolean showProgressDialog = true;

    private int requestMethod = REQUEST_METHOD_GET;

    public RequestAsyncTask(Context context, RequestCompleteListener<String> cb,
                            String webserviceCb, HashMap<String, Object> paramValues) {
        this(context, cb, webserviceCb, paramValues, REQUEST_METHOD_GET, false);
    }

    public RequestAsyncTask(Context context, RequestCompleteListener<String> cb,
                            String webserviceCb, HashMap <String, Object> paramValues,
                            int requestMethod) {
        this(context, cb, webserviceCb, paramValues, requestMethod, false);
    }

    public RequestAsyncTask(Context context, RequestCompleteListener<String> cb,
                            String webserviceCb, HashMap <String, Object>paramValues,
                            int requestMethod, boolean isMultiPartData) {
        callback = cb;
        this.webserviceCb = webserviceCb;
        if (paramValues != null)
            this.paramValues = paramValues;
        this.requestMethod = requestMethod;
        this.isMultiPartData = isMultiPartData;
        if (showProgressDialog) {
            progressDialog = new ProgressDialog(context);
            progressDialog.setCancelable(false);
        }
        checkConnection = new ConnectionDetector(context);
    }

    @Override
    protected void onPreExecute() {
        if (progressDialog != null) {
            progressDialog.setMessage("Loading....");
            progressDialog.setCancelable(false);
            progressDialog.show();
        }
        isNetAvailable = checkConnection.isConnectedToInternet();

    }

    protected String doInBackground(String... url) {
        if (isNetAvailable) {

            try {
                String strUrl = url[0];
                httpClient = new DefaultHttpClient();

                if (requestMethod == REQUEST_METHOD_GET) {
                    if (paramValues != null) {
                        ArrayList<String> arrKey = new ArrayList<String>(paramValues.keySet());

                        for (String string : arrKey) {
                            strUrl = strUrl + string + "=" + paramValues.get(string) + "&";
                        }
                    }
                    Log.d(TAG, "strUrl: " + strUrl);

                    httpget = new HttpGet(strUrl);
                    response = httpClient.execute(httpget);
                } else if(requestMethod == REQUEST_METHOD_POST){

                    List<NameValuePair> nameValuePair = new ArrayList<NameValuePair>();
                    ArrayList<String> arrKey = new ArrayList<String>(paramValues.keySet());

                    for (String key : arrKey) {
                        nameValuePair.add(new BasicNameValuePair(key, paramValues.get(key).toString()));

                    }


                    HttpPost httpPost = new HttpPost(strUrl);
                }

                HttpEntity entity = response.getEntity();
                if (entity != null) {

                    InputStream instream = entity.getContent();

                    BufferedReader reader = new BufferedReader(new InputStreamReader(instream));
                    StringBuilder sb = new StringBuilder();
                    String line = null;
                    while ((line = reader.readLine()) != null) {
                        sb.append(line + "\n");
                    }

                    status = COMPLETED;
                    responseString = sb.toString();
                    instream.close();
                }
            } catch (UnknownHostException e) {
                Log.e(TAG, " doInBackground > UnknownHostException : " + e, e);
                responseString = e.getMessage();
                status = ERROR;
                //handler.sendMessage(handler.obtainMessage(0));
            } catch (Exception e) {
                Log.e(TAG, " doInBackground > Exception : " + e, e);
                responseString = e.getMessage();
                status = ERROR;
                //handler.sendMessage(handler.obtainMessage(1));
            }

            return responseString;
        } else {
            status = INTERNET;
            RequestAsyncTask.this.cancel(isNetAvailable);
        }
        return null;
    }

    protected void onProgressUpdate() {

    }

    protected void onProgressUpdate(Integer... progress) {

    }


    protected void onPostExecute(String responseString) {
        super.onPostExecute(responseString);
        try {
            if (progressDialog != null)
                progressDialog.dismiss();
        } catch (Exception e) {

        }

        callback.onTaskComplete(status, responseString, webserviceCb);
    }

    protected void onCancelled() {
        super.onCancelled();
        try {
            if (progressDialog != null)
                progressDialog.dismiss();
        } catch (Exception e) {

        }

        callback.onTaskComplete(status, "No Internet Connection is available.Please Check your Internet Connection.", webserviceCb);
    }

    private void writeFormField(ByteArrayOutputStream baos, String fieldName, String fieldValue) throws IOException {
        baos.write((twoHyphens + boundary + CRLF).getBytes());
        baos.write(("Content-Disposition: form-data;name=\"" + fieldName + "\"" + CRLF).getBytes("UTF-8"));
        baos.write((CRLF + fieldValue + CRLF).getBytes());
    }

    private void writeFileField(ByteArrayOutputStream baos, String fieldName, String fileName, String contentType, byte[] buf) throws IOException {
        baos.write((twoHyphens + boundary + CRLF).getBytes());
        baos.write(("Content-Disposition: form-data;name=\"" + fieldName + "\";filename=\"" + fileName + "\"" + CRLF).getBytes("UTF-8"));
        baos.write(("Content-Type: " + contentType + CRLF + CRLF).getBytes());
        baos.write(buf);
        baos.write(CRLF.getBytes());
    }
}
