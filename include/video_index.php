<div class="wrap justified_container video_index">
	<div class="video_index_description">
		<p class="video_index_description_title">
			 Приходите и оцените качество дверей
		</p>
		<p class="video_index_description_text">
			 В&nbsp;фирменных салонах и&nbsp;магазинах «Стальная линия» представлено 122&nbsp;образца входных дверей.
		</p>
		<p class="video_index_description_text">
			 Мы&nbsp;установили их&nbsp;не&nbsp;просто так. Только прикоснувшись к&nbsp;двери, вы&nbsp;почувствуете разницу в&nbsp;текстуре покрытий, легко откроете дверь с&nbsp;весом в&nbsp;100&nbsp;кг и&nbsp;убедитесь в&nbsp;плавной работе замков.
		</p>
		<p class="video_index_description_text">
			 Посмотреть на&nbsp;двери и&nbsp;получить консультацию можно по&nbsp;адресам:
		</p>
		<p class="video_index_description_text">
			 ул. Кальварийская, 7Б-6&nbsp;ТЦ «Трюм»;<br>
			 пр. Дзержинского, 131, пом.&nbsp;624.
		</p>
 <a href="/gde_kupit/" target="_blank" class="video_index_description_link">показать ещё 5 адресов</a>
	</div>
	<div class="video_index_file">
		 <iframe id="video_player" width="854" height="480" src="https://www.youtube.com/embed/AGUyKPZegg4?rel=0" frameborder="0" allowfullscreen></iframe>
	</div>
	 <script>
		var videoViewCounter = 0;
		var videoScrollCounter = 0;
		jQuery(document).ready(function($){
		    $('#video_player').iframeTracker({
		        blurCallback: function(){
		        	if(videoViewCounter == 0) {
		        		yaRequest('smotret_video');
		        		videoViewCounter = 1;
		        	}
		        }
		    });
		});
		$(document).scroll(function(e) {
			if($('.video_index_file').length) {
				if(videoScrollCounter == 0 && window.pageYOffset > $('.video_index_file').offset().top*0.5) {
					yaRequest('uvideli_block_video');
					videoScrollCounter = 1;
				}
			}
		})
	</script>
</div>
 <br>