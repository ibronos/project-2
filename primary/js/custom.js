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