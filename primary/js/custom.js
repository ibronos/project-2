/*-------------------------------------------
	Filter Program
-------------------------------------------*/
(function($) {
    "use strict";
    $(document).ready(function() {
        function cIsEmpty(str) {
            return (!str || 0 === str.length || true === (/^\s*$/).test(str));
        }
        $('body').on('click', 'input#submit', function(e) {
            e.preventDefault();

            var c_tr = $('input[name="spotlight_takeover"]:checked');
            if (c_tr.length > 0) {
                var g_k = $('div.spotlight_takeover_content article');
                var t_nm = c_tr[0].id;
                var o_si = g_k.length;
                var a_t = $('div.spotlight_takeover_content article .program_body .program_header .program_title_link_label');
                var k_lop;
                var i_s = $('input#search_by_keyword.input_field.spotlight_takeover_input_field').val();
                if ('view_all_programs' === t_nm) {
                    g_k.removeClass('not_listed').show();
                    $('div.spotlight_takeover_result').html(o_si);
                    for (var i = 0; i < a_t.length; i++) {
                        k_lop = $(a_t[i]).text();
                        if (cIsEmpty(i_s) === false) {
                            var par = $(a_t[i]).parents('article');
                            if (k_lop.toLowerCase().indexOf(i_s.toLowerCase()) > -1) {
                                $(par).show();
                            } else {
                                $(par).hide();
                            }
                        }
                    }
                } else {
                    var art_t = $('div.spotlight_takeover_content article').siblings().not('.' + t_nm);
                    o_si = g_k.length - (art_t.length - 1);
                    $('div.spotlight_takeover_result').html(o_si);
                    g_k.removeClass('not_listed').show();
                    art_t.addClass('not_listed').hide();
                    $('.spotlight_takeover_details').show();
                    for (var i = 0; i < a_t.length; i++) {
                        k_lop = $(a_t[i]).text();
                        if (cIsEmpty(i_s) === false) {
                            var par = $(a_t[i]).parents('article');
                            var thl = $(par).hasClass('not_listed');
                            if (k_lop.toLowerCase().indexOf(i_s.toLowerCase()) > -1) {
                                if(thl === false){
                                    $(par).show();
                                }
                            } else {
                                $(par).hide();
                            }
                        }
                    }
                }
            }
        });
    });
})(jQuery);


/*-------------------------------------------
	Tinymce quote
-------------------------------------------*/
(function() {
	tinymce.PluginManager.add('tric_tinymce_button', function(editor, url) {
		editor.addButton('tric_tinymce_button', {
			icon: false,
			text: "Quote",
			onclick: function() {
				editor.windowManager.open({
					title: "Quote",
					width: 465,
					height: 418,
					body: [
					{
						type: 'textbox',
						name: 'tric_quote',
						multiline:true,
						label: 'Quote',
						value: ''
					},
					{
						type: 'textbox',
						name: 'tric_author',
						placeholder: 'Author',
						label: 'Quote Author',
						value: ''
					},
					{
						type: 'textbox',
						name: 'tric_context',
						placeholder: '\'17 or Biology Professo',
						label: 'Quote Attribution Context',
						value: ''
					}],
					onsubmit: function(e) {
						var tricQuote 		= e.data.tric_quote;
						var tricAuthor 		= e.data.tric_author;
						var tricContext 	= e.data.tric_context;

						var shortCode = '';

						shortCode += '<figure class="quote">';
							shortCode += '<blockquote class="quote_content"><p>'+ tricQuote +'</p></blockquote>';
							shortCode += '';
							shortCode += '<figcaption class="quote_caption">';
								shortCode += '<span class="quote_caption_name"> '+ tricAuthor +'</span>';
								shortCode += '<span class="quote_caption_title"> '+ tricContext +'</span>';
							shortCode += '</figcaption>';
						shortCode += '</figure>';

						editor.insertContent(shortCode);
					}
				});
			}
		});
	});
})();