var app = {
    // Define app properties
    isCapsuleOffline    :   false,                 // Capsule availability
    isMobile            :   false,
    isLogged            :   true,
    errorHandler        :   null,
    ipAddress           :   null
};

app.init = function () {
    // If Capsule is offline, display information notice
    if ( this.isCapsuleOffline ) $( '.capsule-offline' ).show();

    $( '#sidebar ul li.submenu>a' ).on( 'click', app.Common.displaySubmenu );

    if ( !app.isMobile ) {
        $( '<iframe id="external-frame" name="external-frame" frameborder="0" src="blank.html" style="width: 0px; height: 0px;">' ).appendTo( 'body' );
    }

    // Responsive design
    if ( $( window ).width() <= 660 ) {
        $( 'table.courses-list tfoot .left' ).attr( 'colspan', '2' );

        $( 'table.courses-list tbody td:first-child .course-code' ).append( $( '<span class="expand-icon"><i class="icon-chevron-down"></i></span><span class="expand-icon"><i class="icon-chevron-up"></i></span>' ) );
        $( 'table.courses-list tbody td:first-child' ).on( 'click', app.Layout.expandTableCell );
    }

    if ( $( window ).width() <= 480 ) {
        // If there is a sidebar, autoscroll to content
        if ( $( '.sidebar .col-nav' ).length != 0 ) {
            $( 'html, body' ).animate({
                scrollTop: ( $( 'h4.header' ).offset().top - 90 )
            }, 1);
        }
    }

    $( '#in-nav ul .menu a' ).on( 'click', app.Layout.displaySubmenu );

    app.Layout.makeExpandable();

    $( ".dial" ).knob();
  
    for (var a=[],i=0;i<20;++i) a[i]=i;

    // http://stackoverflow.com/questions/962802#962890
    function shuffle(array) {
        var tmp, current, top = array.length;
        if(top) while(--top) {
            current = Math.floor(Math.random() * (top + 1));
            tmp = array[current];
            array[current] = array[top];
            array[top] = tmp;
        }
        return array;
    }

    $(".sparklines").each(function(){
        $(this).sparkline(shuffle(a), {
            type: 'line',
            width: '150',
            lineColor: '#333',
            spotRadius: 2,
            spotColor: "#000",
            minSpotColor: "#000",
            maxSpotColor: "#000",
            highlightSpotColor: '#EA494A',
            highlightLineColor: '#EA494A',
            fillColor: '#FFF'
        });
    });

    $(".sortable").tablesorter();

    $(".pbar").peity("bar", {
        colours: ["#EA494A"],
        strokeWidth: 4,
        height: 32,
        max: null,
        min: 0,
        spacing: 4,
        width: 58
    });

    $( '#in-nav .external-frame a' ).on( 'click', app.Common.closeExternalFrame );

    $( '#in-sub-nav li.exchange a' ).on( 'click', function(){
        if ( $( window ).width() > 660 ) {
            app.Common.openExternalWebsite( $( '#in-sub-nav li.exchange a' ).data( 'url' ) );
        } else {
            document.location = $( '#in-sub-nav li.exchange a' ).data( 'url' );
        }

        return false;
    } );
};

app.Layout = {};

// Make content sections expandable
app.Layout.makeExpandable = function () {
    $( '.table-panel:not(.not-expandable)' ).addClass( 'expandable' ).find( 'h4' ).append( $( '<span class="expand-icon"><i class="icon-chevron-down"></i></span><span class="expand-icon"><i class="icon-chevron-up"></i></span>' ) ).on( 'click', app.Layout.expand );
};

app.Layout.expand = function ( e ) {
    if ( $( window ).width() > 480 )
        return false;

    $( e.currentTarget ).closest( '.table-panel' ).toggleClass( 'expanded' );

    if ( $( e.currentTarget ).closest( '.table-panel' ).hasClass( 'expanded' ) ) {
        $('html, body').animate({
            scrollTop: ( $( e.currentTarget ).closest( '.table-panel' ).offset().top - 80 )
        }, 400);
    }
    
    return false;
};

app.Layout.expandTableCell = function ( e ) {
    if ( $( window ).width() > 480 )
        return false;

    $( e.currentTarget ).toggleClass( 'expanded' );
    
    return false;
};

app.Layout.displaySubmenu = function () {
    var submenu = $( '#in-sub-nav' );

    if ( submenu.is( ':visible' ) ) {
        submenu.slideUp( 'normal', function() {
        });
    } else {
        submenu.slideDown( 'normal', function() { });
    }

    if ( $(document).scrollTop() != 0 ) {
        $( 'html, body' ).animate({
            scrollTop: ( 0 )
        }, 200);
    }

    return false;
};

app.Common = {};

// Resize external view iframe on window resize
app.Common.resizeExternalFrame = function () {
    $( '#external-frame' ).css( 'width', $( window ).width() );
    $( '#external-frame' ).css( 'height', $( window ).height() - 42 );
};

// Open external website in external view frame
app.Common.openExternalWebsite = function ( url ) {
    app.Common.resizeExternalFrame();
    
    // Display external view frame
    $( '#external-frame' ).attr( 'src', url ).fadeIn();

    // Hide normal navigation menu
    $( '#in-nav #user-nav' ).hide();
    $( '#in-nav .external-frame' ).fadeIn();
};

app.Common.closeExternalFrame = function () {
    // Hide external view frame
    $( '#external-frame' ).fadeOut().attr( 'src', 'blank.html' );

    // Reset default menu navigation
    $( '#in-nav .external-frame' ).hide();
    $( '#in-nav .external-frame li' ).removeClass( 'active' );
    $( '#in-nav #user-nav' ).fadeIn();

    $( 'html, body' ).animate( { scrollTop: 0 }, 1 );
};

app.Common.displaySubmenu = function ( e ) {
    object = $( e.currentTarget );
    var submenu = $( object ).siblings( 'ul' );
    var li = $( object ).parents( 'li' );
    var submenus = $( '#sidebar li.submenu ul' );
    var submenus_parents = $( '#sidebar li.submenu' );
    if ( li.hasClass( 'open' ) ) {
        if ( ( $( window ).width() > 768 ) || ( $( window ).width() < 479 ) ) {
            submenu.slideUp();
        } else {
            submenu.fadeOut( 250 );
        }
        li.removeClass( 'open' );
    } else {
        if ( ( $( window ).width() > 768 ) || ( $( window ).width() < 479 ) ) {
            submenus.slideUp();
            submenu.slideDown();
        } else {
            submenus.fadeOut( 250 );
            submenu.fadeIn( 250 );
        }

        submenus_parents.removeClass( 'open' );
        li.addClass( 'open' );
    }

    return false;
};

// Show modal
app.Common.showModal = function ( params ) {
    $( '#modal' ).load( params.url, function() {
        $( '#modal' ).modal( 'show' );

        // Execute callback, if needed
        if ( params.callback ) {
            ( params.callback )();
        }
    } );
};

// Display loading message
app.Common.loading = function ( object, message ) {

};

// Hide loading message
app.Common.stopLoading = function () {

};

// Display error message
app.Common.displayError = function ( message, object, autoHide ) {
    if ( object == null ) {
        object = '.alert.alert-error';
    }

    $( object ).html( message );
    $( object ).fadeIn();

    if ( autoHide != false ) {
        setTimeout( function(){ $( object ).fadeOut(); }, 2500 );
    }
};

app.Common.refreshPage = function () {
    location.reload();
};

app.Common.refreshPageContent = function ( auto ) {
    // Reload the page content
    $( '.main' ).load( document.location + ' .inner-content', function( e ) {
        // If cache reload request was not automatic, display a success message
        if ( auto != true ) {
            toastr.options = {
                positionClass: 'toast-bottom-left'
            };

            toastr.success( 'Les données ont été actualisées depuis Capsule.', 'Actualisation des données' );
        }

        // Flash the content to alert the user of the update
        $( '.container .main' ).fadeOut( 200, function(){
            $( '.container .main' ).fadeIn( 400 );
        } );
    } );
};

app.Common.setErrorHandler = function ( handler ) {
    app.errorHandler = handler;
};

app.Common.unsetErrorHandler = function ( handler ) {
    app.errorHandler = null;
};

app.Common.dispatchError = function ( error ) {
    // Attempt to display the error message
    if ( typeof error.message == 'undefined' ) {
        switch ( error.context ) {
            case 'ajax-server-error':
                error.message = 'Une erreur est survenue durant l\'exécution de la fonction demandée sur le serveur';
                break;
            case 'ajax-server-timeout':
                error.message = 'Le serveur n\'a pas répondu dans un délai suffisant';
                break;
            case 'ajax-server-invalid-response':
                error.message = 'Le serveur a renvoyé une réponse invalide';
                break;
            default:
                error.message = 'Une erreur inconnue est survenue durant l\'exécution de la fonction demandée';
                break;
        }
    }

    // Check if an error handler is defined
    if ( app.errorHandler != null ) {
        // Pass the error message to the error handler
        ( app.errorHandler )( error );
    } else {
        app.Common.displayError( error.message );
    }
};
// Functions used for retrocompatibility
function loading( object, message ) {
    app.Common.loading( object, message );
}

function stopLoading () {
    app.Common.stopLoading();
}

function errorMessage( message ) {
    // Check if an error handler is defined
    if ( app.errorHandler != null ) {
        // Pass the error message to the error handler
        ( app.errorHandler )( message );
    } else {
        // Attempt to display the error message
        app.Common.displayError( message );
    }
}