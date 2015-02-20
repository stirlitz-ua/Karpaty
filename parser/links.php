<a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=22' target='_blank'>year=2007&model=22</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=23' target='_blank'>year=2007&model=23</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=24' target='_blank'>year=2007&model=24</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=25' target='_blank'>year=2007&model=25</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=26' target='_blank'>year=2007&model=26</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=27' target='_blank'>year=2007&model=27</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=28' target='_blank'>year=2007&model=28</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=29' target='_blank'>year=2007&model=29</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=30' target='_blank'>year=2007&model=30</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=31' target='_blank'>year=2007&model=31</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=32' target='_blank'>year=2007&model=32</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=33' target='_blank'>year=2007&model=33</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=34' target='_blank'>year=2007&model=34</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=35' target='_blank'>year=2007&model=35</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=36' target='_blank'>year=2007&model=36</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=37' target='_blank'>year=2007&model=37</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=38' target='_blank'>year=2007&model=38</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=39' target='_blank'>year=2007&model=39</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=40' target='_blank'>year=2007&model=40</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=41' target='_blank'>year=2007&model=41</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=42' target='_blank'>year=2007&model=42</a><a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=2007&model=43' target='_blank'>year=2007&model=43</a>
<?php

$n=0;
for ($i=2006;$i>=2000;$i--){
	for ($j=1;$j<=43;$j++){
		$n++;
	
		echo "<a style='display:none;' class='iframes' href='http://karpaty-autocenter.com.ua/parser/c.php?test=2&year=".$i."&model=".$j."' target='_blank'>year=".$i."&model=".$j."</a>";
		echo "";
	}
		echo "";
}

?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
	jQuery(function($){
		var n = 0;
		$('iframe').on('load', function(){
			n++;
			console.log('loaded '+n);
		
				$(this).attr('src', $('a:nth-child('+n+').iframes').attr('href'));
			
			console.log('a href '+$('a:nth-child('+n+').iframes').attr('href'));
			$('div.console').append('loaded '+n+' '+$('a:nth-child('+n+').iframes').attr('href')+' <br/>');
		});
	});
</script>
<iframe src="http://karpaty-autocenter.com.ua" width="1200" height="200"></iframe>
<br/>
<br/>

<div class="console">
</div>