package wohoo.app.com.wohoo;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;

import wohoo.app.com.wohoo.model.User;
import wohoo.app.com.wohoo.request.Constant;
import wohoo.app.com.wohoo.request.RequestAsyncTask;
import wohoo.app.com.wohoo.request.RequestCompleteListener;


public class LoginActivity extends ActionBarActivity implements View.OnClickListener, RequestCompleteListener<String>{

    private EditText editEmail;
    private EditText editPwd;
    private Button btnSignIn;
    private Button btnRegister;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        setTitle(R.string.title_activity_login);

        editEmail = (EditText) findViewById(R.id.editEmail);
        editPwd = (EditText) findViewById(R.id.editPwd);
        btnSignIn = (Button) findViewById(R.id.btnSignIn);
        btnRegister = (Button) findViewById(R.id.btnRegister);

        btnSignIn.setOnClickListener(this);
        btnRegister.setOnClickListener(this);
    }

    private boolean validateField(String email, String pwd) {

        boolean isValid = true;

        if(TextUtils.isEmpty(email)) {
            editEmail.setError("Please enter email");
            isValid = false;
        } else if(!android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            editEmail.setError("Please Enter Valid Email Address");
        } else if(TextUtils.isEmpty(pwd)) {
            editPwd.setError("Please enter password");
            isValid = false;
        }

        return  isValid;

    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.btnSignIn :
                String email = editEmail.getText().toString();
                String pwd = editPwd.getText().toString();

                if(validateField(email, pwd)) {
                    initLoginRequest(email, pwd);
                }

                break;
            case R.id.btnRegister:
                startActivityForResult(new Intent(LoginActivity.this, RegisterActivity.class), 101);
                break;
        }
    }

    private void initLoginRequest(String email, String password) {
        HashMap<String, Object> userData = new HashMap<>();
        userData.put("mail", email);
        userData.put("password", password);

        RequestAsyncTask loginReq = new RequestAsyncTask(this, this, Constant.REQ_LOGIN, userData);
        loginReq.execute(Constant.REQ_LOGIN);
    }

    @Override
    public void onTaskComplete(int statusCode, String result, String webserviceCb) {
        if(statusCode == RequestAsyncTask.COMPLETED) {
            parseLoginJson(result);
        } else if(statusCode == RequestAsyncTask.CANCELED) {

        }
    }

    private User parseLoginJson(String response) {
        User userObj = null;
        try {
            JSONObject json = new JSONObject(response);
            JSONArray loginResponse = json.getJSONArray("login");
            String status = loginResponse.getJSONObject(3).getString("status");
            if(status.equalsIgnoreCase("valid")) {
                String  email = loginResponse.getJSONObject(0).getString("mail");
                String firstname = loginResponse.getJSONObject(1).getString("firstname");
                String lastname = loginResponse.getJSONObject(2).getString("lastname");

                userObj = new User(email, firstname, lastname);

                startActivity(new Intent(LoginActivity.this, ImagesActivity.class));
                finish();
            } else {
                showAlert("Invalid Email / Password, Please try again.");
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }

        return  userObj;
    }

    private void showAlert(String message) {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setMessage(message).setTitle("Wohoo!")
                .setCancelable(false)
                .setPositiveButton("OK", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        // do nothing
                    }
                });
        AlertDialog alert = builder.create();
        alert.show();
    }
}
