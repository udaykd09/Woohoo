package wohoo.app.com.wohoo.model;

import java.util.List;

/**
 * Created by aalapshah on 03/05/15.
 */
public class User {

    private String email;
    private String firstName;
    private String lastName;
    private List<String> imageUrls;

    public User(String email, String firstName, String lastName) {
        this.email = email;
        this.firstName = firstName;
        this.lastName = lastName;
    }

    public String getEmail() {
        return email;
    }

    public String getFirstName() {
        return firstName;
    }

    public String getLastName() {
        return lastName;
    }

    public List<String> getImageUrls() {

        return imageUrls;
    }

    public void setImageUrls(List<String> imageUrls) {
        this.imageUrls = imageUrls;
    }
}
