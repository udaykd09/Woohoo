package wohoo.app.com.wohoo.request;

public interface RequestCompleteListener<T>
{
	public void onTaskComplete(int statusCode, T result, String webserviceCb);
}
