$('#tabla').each(function() {
    var currentPage = 0;
    var numPerPage = 12;
    var $table = $(this);
    $table.bind('repaginate', function() {
        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
    });
    $table.trigger('repaginate');
    var numRows = $table.find('tbody tr').length;
    var numPages = Math.ceil(numRows / numPerPage);
    var $pager = $('<div class="pager"></div>');
    for (var page = 0; page < numPages; page++) {
        $('<span class="page-number" style="color: var(--color-primary)";></span>').text((page + 1)+'\xa0\xa0\xa0\xa0\xa0\xa0').bind('click', {
            newPage: page
        }, function(event) {
            currentPage = event.data['newPage'];
            $table.trigger('repaginate');
            $(this).addClass('active').siblings().removeClass('active');

        }).appendTo('#tabla').addClass('clickable');
    }
    $pager.insertBefore($table).find('span.page-number:first').addClass('active');
});