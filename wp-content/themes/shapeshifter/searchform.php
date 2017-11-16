<form name="search-form" class="search-form" method="get" action="<?php echo esc_url( SHAPESHIFTER_SITE_URL ); ?>/">
	<div class="search-form-box">
		<div class="row">
			<div class="col-md-12">
				<div id="custom-search-input">
					<div class="input-group col-md-12">
						<input name="s" type="text" class="keywords form-control input-lg search-box-text-field" value="<?php esc_attr( the_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search', 'shapeshifter' ); ?>" />
						<span class="input-group-btn">
							<button class="btn btn-info btn-lg search-box-button" type="submit">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>