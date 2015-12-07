package wohoo.app.com.wohoo;

import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

import java.util.HashMap;

import wohoo.app.com.wohoo.request.Constant;
import wohoo.app.com.wohoo.request.RequestAsyncTask;
import wohoo.app.com.wohoo.request.RequestCompleteListener;


public class RegisterActivity extends ActionBarActivity implements View.OnClickListener, RequestCompleteListener<String> {


    private EditText editFirstName;
    private EditText editLastName;
    private EditText editEmail;
    private EditText editPwd;
    private RadioGroup rgGender;
    private RadioButton rbMale;
    private RadioButton rbfemale;
    private CheckBox cbTerms;
    private Button btnSignUp;
    private Button btnCancel;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registration);

        editFirstName = (EditText) findViewById(R.id.editFirstName);
        editLastName = (EditText) findViewById(R.id.editLastName);
        editEmail = (EditText) findViewById(R.id.editEmail);
        editPwd = (EditText) findViewById(R.id.editPwd);
        rgGender = (RadioGroup) findViewById(R.id.rgGender);
        rbMale = (RadioButton) findViewById(R.id.rbMale);
        rbfemale = (RadioButton) findViewById(R.id.rbfemale);
        cbTerms = (CheckBox) findViewById(R.id.cbTerms);
        btnSignUp = (Button) findViewById(R.id.btnSignUp);
        btnCancel = (Button) findViewById(R.id.btnCancel);

        btnCancel.setOnClickListener(this);
        btnSignUp.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {

        switch (v.getId()) {

            case R.id.btnSignUp:
                if(validateFields()) {
                    registerUser();

                }
                break;

            case  R.id.btnCancel :
                finish();
                break;
        }
    }

    private boolean validateFields() {

        boolean isValid = true;

        String firstName = editFirstName.getText().toString();
        String lastName = editLastName.getText().toString();
        String email = editEmail.getText().toString();
        String pwd = editPwd.getText().toString();

        if(TextUtils.isEmpty(firstName)) {
            editFirstName.setError("Please enter firstname");
            isValid = false;
        } else if (TextUtils.isEmpty(lastName)) {
            editLastName.setError("Please enter lastname");
            isValid = false;
        } else if(TextUtils.isEmpty(email)) {
            editEmail.setError("Please enter email");
            isValid = false;
        } else if(!android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            editEmail.setError("Please Enter Valid Email Address");
            isValid = false;
        } else if(TextUtils.isEmpty(pwd)) {
            editPwd.setError("Please enter password");
            isValid = false;
        } else if(rgGender.getCheckedRadioButtonId() == -1) {
            Toast.makeText(this,"Please select gender", Toast.LENGTH_LONG).show();
            isValid = false;
        } else if(!cbTerms.isChecked()) {
            Toast.makeText(this,"Please check terms", Toast.LENGTH_LONG).show();
            isValid = false;
        }

        return isValid;
    }

    private void registerUser() {
        HashMap<String, Object> userData = new HashMap<>();
        userData.put("mail", editEmail.getText().toString());
        userData.put("password", editPwd.getText().toString());
        userData.put("firstname", editFirstName.getText().toString());
        userData.put("lastname", editLastName.getText().toString());


        RequestAsyncTask loginReq = new RequestAsyncTask(this, this, Constant.REQ_REG, userData);
        loginReq.execute(Constant.REQ_REG);
    }


    @Override
    public void onTaskComplete(int statusCode, String result, String webserviceCb) {
        finish();
    }
}
