$(document).on('click','.play-next', function(e){
    e.preventDefault();
    var current_week = $( "input[name='current_week']" ).val();

    if(current_week < 5){
        $.ajax({
            url: 'match',
            type: "GET",
            data: {current_week:current_week},
            success: function(data){
                ++current_week;
                $( "input[name='current_week']" ).val(current_week);
                $('#result').append(data);
            },
            error: function(data){
            },
        });
    }
});

$(document).on('click','#clear', function(e){
    e.preventDefault();
    $( "input[name='current_week']" ).val('1');

    $.ajax({
        url: 'clear',
        type: "GET",
        data: {},
        success: function(data){
            $( "input[name='current_week']" ).val('1');
            $('#result').html('');
            alert('Done!');
        },
        error: function(data){
        },
    });
});

$(document).on('click','.play-all', function(e){
    e.preventDefault();
    var current_week = $( "input[name='current_week']" ).val();

    if(current_week < 5){
        $.ajax({
            url: 'all',
            type: "GET",
            data: {current_week:current_week,all:true},
            success: function(data){
                ++current_week;
                $( "input[name='current_week']" ).val('5');
                $('#result').append(data);
            },
            error: function(data){
            },
        });
    }
});
