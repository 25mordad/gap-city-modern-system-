<div class="row">
	<div class="row"  >
	<div class="col-xs-12" >
  	 قیمت اصلی
  - نمایش 10 محصول آخر
  
  <a href="?type=real">قیمت واقعی</a> | 
  <a href="?type=s1"> حراج ۱</a> | 
  <a href="?type=s2">حراج ۲ </a> |
  <a href="?type=min">قیمت مینیمم</a>
  	</div>
  	</div>
   
  <hr>
  {if $smarty.get.type eq "real"}
  <div class="row" style="margin-right: 10px">
  	<a href="?type=real&update=true" >به روزرسانی قیمت</a>
  	<hr>
  	<div class="col-xs-6" >
  	<b>نام کالا</b>
  	</div>
  	<div class="col-xs-3" >
    <b>قیمت</b> 
  	</div>
  	<div class="col-xs-2" >
    <b>قیمت جدید</b>
  	</div>
  	<div class="clearfix" ></div>
  	{foreach $products as $row}
	  	<div class="col-xs-6" style="margin-top: 10px" >
	  	{$row->fa_title}
	  	</div>
	  	<div class="col-xs-3" style="margin-top: 10px" >
	    {number_format($row->price)} 
	  	</div>
	  	<div class="col-xs-2" style="margin-top: 10px" >
	   {$p = ( ($row->real_price + 25) +  (($row->real_price + 25 )*20/100 ) )* $GCMS_SETTING['shop']['eurorate']  }
	   {$finp = ceil($p/10000)*10000-1000}
	   {number_format($finp)} 
	  	</div>
	  	<div class="col-xs-1" style="margin-top: 10px" >
	   	<span style="color:red">
	   		{number_format($finp-$row->price)}
	   	</span>
	  	</div>
	  	<div class="clearfix" ></div>
  	{/foreach}
  </div>
  {/if}
  {if $smarty.get.type eq "min"}
  <div class="row" style="margin-right: 10px">
  	<a href="?type=min&update=true" >به روزرسانی قیمت</a>
  	<hr>
  	<div class="col-xs-6" >
  	<b>نام کالا</b>
  	</div>
  	<div class="col-xs-3" >
    <b>قیمت</b> 
  	</div>
  	<div class="col-xs-2" >
    <b>قیمت جدید</b>
  	</div>
  	<div class="clearfix" ></div>
  	{foreach $products as $row}
	  	<div class="col-xs-6" style="margin-top: 10px" >
	  	{$row->fa_title}
	  	</div>
	  	<div class="col-xs-3" style="margin-top: 10px" >
	    {number_format($row->min_price)} 
	  	</div>
	  	<div class="col-xs-2" style="margin-top: 10px" >
	   {$p = ( ($row->buy_price + 10) +  (($row->buy_price + 10 )*20/100 ) )* $GCMS_SETTING['shop']['eurorate']  }
	   {$finp = ceil($p/10000)*10000-1000}
	   {number_format($finp)} 
	  	</div>
	  	<div class="col-xs-1" style="margin-top: 10px" >
	   	<span style="color:red">
	   		{number_format($finp-$row->min_price)}
	   	</span>
	  	</div>
	  	<div class="clearfix" ></div>
  	{/foreach}
  </div>
  {/if}
  {if $smarty.get.type eq "s2"}
  <div class="row" style="margin-right: 10px">
  	<a href="?type=s2&update=true" >به روزرسانی قیمت</a>
  	<hr>
  	<div class="col-xs-6" >
  	<b>نام کالا</b>
  	</div>
  	<div class="col-xs-3" >
    <b>قیمت</b> 
  	</div>
  	<div class="col-xs-2" >
    <b>قیمت جدید</b>
  	</div>
  	<div class="clearfix" ></div>
  	{foreach $products as $row}
	  	<div class="col-xs-6" style="margin-top: 10px" >
	  	{$row->fa_title}
	  	</div>
	  	<div class="col-xs-3" style="margin-top: 10px" >
	    {number_format($row->sales2_price)} 
	  	</div>
	  	<div class="col-xs-2" style="margin-top: 10px" >
	   {$p = ( $row->price +$row->min_price )/2   }
	   {$finp = ceil($p/10000)*10000-1000}
	   {number_format($finp)} 
	  	</div>
	  	<div class="col-xs-1" style="margin-top: 10px" >
	   	<span style="color:red">
	   		{number_format($finp-$row->sales2_price)}
	   	</span>
	  	</div>
	  	<div class="clearfix" ></div>
  	{/foreach}
  </div>
  {/if}
  {if $smarty.get.type eq "s1"}
  <div class="row" style="margin-right: 10px">
  	<a href="?type=s1&update=true" >به روزرسانی قیمت</a>
  	<hr>
  	<div class="col-xs-6" >
  	<b>نام کالا</b>
  	</div>
  	<div class="col-xs-3" >
    <b>قیمت</b> 
  	</div>
  	<div class="col-xs-2" >
    <b>قیمت جدید</b>
  	</div>
  	<div class="clearfix" ></div>
  	{foreach $products as $row}
	  	<div class="col-xs-6" style="margin-top: 10px" >
	  	{$row->fa_title}
	  	</div>
	  	<div class="col-xs-3" style="margin-top: 10px" >
	    {number_format($row->salse1_price)} 
	  	</div>
	  	<div class="col-xs-2" style="margin-top: 10px" >
	   {$p = ( $row->price +$row->sales2_price )/2   }
	   {$finp = ceil($p/10000)*10000-1000}
	   {number_format($finp)} 
	  	</div>
	  	<div class="col-xs-1" style="margin-top: 10px" >
	   	<span style="color:red">
	   		{number_format($finp-$row->salse1_price)}
	   	</span>
	  	</div>
	  	<div class="clearfix" ></div>
  	{/foreach}
  </div>
  {/if}
</div>