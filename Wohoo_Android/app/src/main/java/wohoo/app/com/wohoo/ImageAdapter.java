package wohoo.app.com.wohoo;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.ProgressBar;

import com.squareup.picasso.Callback;
import com.squareup.picasso.Picasso;

import java.util.List;

/**
 * Created by aalapshah on 03/05/15.
 */
public class ImageAdapter extends BaseAdapter {

    private List<String> imageUrlList;
    private LayoutInflater inflater;
    private Context context;

   public ImageAdapter(Context context, List<String> imageUrl) {
        inflater = LayoutInflater.from(context);
        this.imageUrlList = imageUrl;
        this.context = context;
    }

    @Override
    public int getCount() {
        return  this.imageUrlList.size();
    }

    @Override
    public Object getItem(int position) {
        return null;
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        final ViewHolder holder;
        if(convertView == null) {
            holder = new ViewHolder();
            convertView = inflater.inflate(R.layout.item_images, parent, false);
            holder.img = (ImageView) convertView.findViewById(R.id.img);
            holder.progress = (ProgressBar) convertView.findViewById(R.id.progress);
            convertView.setTag(holder);
        } else {
            holder = (ViewHolder) convertView.getTag();
        }

        Picasso.with(context).load(this.imageUrlList.get(position)).into(holder.img, new Callback() {
            @Override
            public void onSuccess() {
                holder.progress.setVisibility(View.GONE);
            }

            @Override
            public void onError() {
                holder.progress.setVisibility(View.GONE);
            }
        });

        return convertView;
    }

    class ViewHolder {
        ImageView img;
        ProgressBar progress;
    }
}
