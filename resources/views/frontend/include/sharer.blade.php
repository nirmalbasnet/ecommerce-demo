<div class="product-detail-share">
    <div class="article-share-top article-share-bar">
        <ul>
            <li>
                <a onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{\Illuminate\Support\Facades\Request::fullUrl()}}', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
                   href="javascript:void(0);" class="facebook" title="Share on Facebook"><i
                            class="fa fa-facebook"></i> Share</a></li>
            <li>
                <a onclick="window.open('https://twitter.com/intent/tweet?via=Kankai;text={{$product->name}};url={{\Illuminate\Support\Facades\Request::fullUrl()}}', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
                   href="javascript:void(0);" class="twitter" title="Share on Twitter"><i
                            class="fa fa-twitter"></i> Tweet</a></li>
            <li>
                <a onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&amp;title={{$product->name}}&amp;url={{\Illuminate\Support\Facades\Request::fullUrl()}}', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
                   href="javascript:void(0);" class="linkedin" title="Share on LinkedIn"><i
                            class="fa fa-linkedin"></i> Share</a></li>
        </ul>
    </div>
</div>