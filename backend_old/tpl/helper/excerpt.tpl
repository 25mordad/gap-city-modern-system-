
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">خلاصه محتوای @@{$part}@@</div>
                    <img src="{$loct}/images/icon/excerpt.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <div class="ctrlHolder">
                        	<textarea name="pg_excerpt" id="pg_excerpt" class="large" >{if $action eq "edit"}{${$part}->pg_excerpt}{/if}</textarea>
                    	</div>
					</div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->