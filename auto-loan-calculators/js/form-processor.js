jQuery(document).ready(function($) {
    // ---------------------
    // UI for the form modal
    // ---------------------
    $('.modal-btn').click(function(e) {
        e.preventDefault();
        var modal = $(this).data('modal');
        $(`#${modal}`).parent('.modal-wrap').addClass('active');
    });
    $('.modal-close').click(function(e) {
        e.preventDefault();
        $('.modal-wrap').removeClass('active');
    });
    $('.modal-overlay').click(function(e) {
        e.preventDefault();
        $('.modal-wrap').removeClass('active');
    });

    // ---------------------------------
    // UI for the featured partner modal
    // ---------------------------------
    $('.featured-modal-btn').click(function(e) {
        e.preventDefault();
        $('#featured-partner-form .form-input').val('');

        var modal_heading = $(this).data('heading');
        var modal_instructions = $(this).data('instructions');
        var modal_disclaimer = $(this).data('disclaimer');
        var partner_email = $(this).data('partner-email');
        var account_number = $(this).data('account-number');

        var logo_src = $(this).data('logo-src');
        var logo_alt = $(this).data('logo-alt');

        $('#featured-partner-form .form-header').html(modal_heading);
        $('#featured-partner-form .form-instructions').html(modal_instructions);
        $('#featured-partner-form .form-disclaimer').html(modal_disclaimer);
        $('#featured-partner-form').attr('data-partner-email', partner_email);
        $('#featured-partner-form').attr('data-account-number', account_number);

        if (logo_src) {
            $('#featured-partner-form .form-logo').attr('src', logo_src);
            $('#featured-partner-form .form-logo').attr('alt', logo_alt);
        } else {
            $('#featured-partner-form .form-logo').attr('src', '');
            $('#featured-partner-form .form-logo').attr('alt', '');
        }

        $('.featured-partner-wrap').addClass('active');
    });

    // ---------------------------------------------------------------------
    // UI and database for the for 'New Car' form's make and model dropdowns
    // ---------------------------------------------------------------------
    // building a 'car_models' object to store the various arrays of car models and trims
    const car_models = {
        acura_models : {
            ilx : {
                name : 'ILX',
                // trims : ['4DR Sedan (2.0L 4CYL 5A)', 'Premium Package 4DR Sedan (2.0L 4CYL 5A)', 'Premium Package 4DR Sedan (2.4L 4CYL 6M)', 'Technology Package 4DR Sedan (2.0L 4CYL 5A)'],
            },
            mdx : {
                name : 'MDX',
                // trims : ['4DR SUV (3.5L 6CYL 6A)', 'Advance & Entertainment Packages 4DR SUV (3.5L 6CYL 6A)', 'SH-AWD 4DR SUV AWD (3.5L 6CYL 6A)', 'SH-AWD w/ Advanced & Entertainment Packages 4DR SUV AWD (3.5L 6CYL)', 'SH-AWD w/ Technology Package 4DR SUV (3.5L 6CYL 6A)', 'SH-AWD w/ Technology & Entertainment Packages 4DR SUV AWD (3.5L)', 'Technology Package 4DR SUV (3.5L 6CYL 6A)', 'Technology & Entertainment Package 4DR SUV (3.5L 6CYL 6A)'],
            },
            nsx : {
                name : 'NSX',
                // trims: ['2DR Coupe AWD (3.5L 6CYL Gas/Electric Hybrid 7A'],
            },
            rdx : {
                name : 'RDX',
                // trims : ['4DR Sedan (3.5L 6CYL 6A)', 'Advanced Package 4DR Sedan (3.5L 6CYL 6A)', 'Krell Audio Package 4DR Sedan (3.5L 6CYL 6A)', 'Navigation 4DR Sedan (3.5L 6CYL 6A)', 'Technology Package 4DR Sedan (3.5L 6CYL 6A)', '4DR SUV (3.5L 6CYL 6A)', '4DR SUV AWD (3.5L 6CYL 6A)', 'Technology Package 4DR SUV (3.5L 6CYL 6A)', 'Technology Package 4DR SUV AWD (3.5L 6CYL 6A)'],
            },
            tlx : {
                name : 'TLX',
                // trims : ['4DR Sedan (2.4L 4CYL 8AM)', '4DR Sedan (3.5L 6CYL 9A)', 'Advanced Package 4DR Sedan (3.5L 6CYL 9A)', 'SH-AWD w/ Advanced Package 4DR Sedan AWD (3.5L 6CYL 9A)', 'SH-AWD w/ Technology Package 4DR Sedan AWD (3.5L 6CYL 9A', 'Technology Package 4DR Sedan (2.4L 4CYL 8AM)', 'Technology Package 4DR Sedan (3.5L 6CYL 9A)'],
            },
        },
        alfa_models : {
            _4c : {
                name : '4C',
                // trims : ['2DR Coupe (1.7L 4CYL Turbo 6AM', 'Launch Edition 2DR Coupe (1.7L 4CYL Turbo 6AM'],
            }
        },
        aston_models : {
            v12_vintage_s : {
                name : 'V12 Vintage S',
                // trims : ['2DR Coupe (6.0L 12CYL 7AM'],
            },
        },
        audi_models : {
            a3 : {
                name : 'A3',
                // trims : ['1.8 TFSI Premium 2DR Convertible (1.8L 4CYL Turbo 6AM)', '1.8 TFSI Premium Plus 2D Convertible (1.8L 4CYL Turbo 6AM)', '1.8 TFSI Prestige 2D Convertible (1.8L 4CYL Turbo 6AM)', '1.8 TFSI Premium 4DR Sedan (1.8L 4CYL Turbo 6AM)', '1.8 TFSI Premium Plus 4DR Sedan (1.8L 4CYL Turbo 6AM)', '1.8 TFSI Prestige 4DR Sedan (1.8L 4CYL Turbo 6AM)', '2.0 TDI Premium 4DR Sedan (2.0L 4CYL Turbodiesel 6AM)', '2.0 TDI Premium Plus 4DR Sedan (2.0L 4CYL Turbodiesel 6AM)', '2.0 TDI Prestige 4DR Sedan (2.0L 4CYL Turbodiesel 6AM)', '2.0 TFSI Premium Quattro 2DR Converitble AWD (2.0L 4CYL Turbo 6A)', '2.0 TFSI Premium Plus Quattro Convertible AWD (2.0L 4CYL Turbo 6AM)', '2.0 TFSI Prestige Quattro 2DR Convertible AWD (2.0L 4CYL Turbo 6)', '2.0 TFSI Premium Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 6AM)', '2.0 TFSI Premium Plus Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 6AM)', '2.0 TFSI Prestige Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 6AM)'],
            },
            a3_e_tron : {
                name : 'A3 E-Tron',
                // trims : ['4DR Hatchback (1.4L 4CYL Gas/Electric Hybrid 6AM)'],
            },
            a4 : {
                name : "A4",
                // trims : ['2.0T Premium 4DR Sedan (2.0L 4CYL Turbo CVT', '2.0T Premium Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 6M)', '2.0T Premium Plus 4DR Sedan (2.0L 4CYL Turbo CVT)', '2.0T Premium Plus Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 6M)', '2.0T Prestige 4DR Sedan (2.0L 4CYL Turbo CTV)', '2.0T Prestige Quattro 4DR Sedan (2.0L 4CYL Turbo 6M)', '2.0T Premium Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 8A)', '2.0T Premium Plus Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 8A)', '2.0T Prestige Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 8A)'],
            },
            a5 : {
                name : 'A5',
                // trims : ['2.0T Premium Quattro 2DR Coupe AWD (2.0L 4CYL Turbo 6M)', '2.0T Premium Plus Quattro 2DR Coupe AWD (2.0L 4CYL Turbo 6M)', '2.0T Prestige Quattro 2DR Coupe AWD (2.0L 4CYL Turbo 6M)', '2.0T Premium Quattro 2DR Coupe AWD (2.0L 4CYL Turbo 8A)', '2.0T Premium Plus Quattro 2DR Coupe AWD (2.0L 4CYL Turbo 8A)', '2.0T Prestige Quattro 2DR Coupe AWD (2.0L 4CYL Turbo 8A)', '2.0T Premium Quattro 2DR Convertible AWD (2.0L 4CYL Turbo 8A)', '2.0T Premium Plus Quattro 2DR Convertible AWD (2.0L 4CYL Turbo 8A)', '2.0T Prestige Quattro 2DR Convertible AWD (2.0L 4CYL Turbo 8A)'],
            },
            a6 : {
                name : 'A6',
                // trims : ['2.0T Premium 4DR Sedan (2.0L 4CYL Turbo CVT)', '2.0T Premium Plus 4DR Sedan (2.0L 4CYL Turbo CVT)', '2.0T Premium Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 8A)', '2.0T Premium Plus Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 8A)', '3.0T Premium Plus Quattro 4DR Sedan AWD (3.0L 6CYL S/C 8A)', '3.0T Prestige Quattro 4DR Sedan AWD (3.0L 6CYL S/C 8A)', 'TDI Premium Plus Quattro 4DR Sedan AWD (3.0L 6CYL Turbodiesel 8A)', 'TDI Prestige Quattro 4DR Sedan AWD (3.0L 6CYL Turbodiesel 8A)'],
            },
            a7 : {
                name : 'A7',
                // trims : ['Premium Plus Quattro 4DR Sedan AWD (3.0L 6CYL S/C 8A)', 'Prestige Quattro 4DR Sedan AWD (3.0L 6CYL S/C 8A)', 'TDI Premium Plus Quattro 4DR Sedan AWD (3.0L 6CYL Turbodiesel 8A)', 'TDI Prestige Quattro 4DR Sedan AWD (3.0L 6CYL Turbodiesel 8A)'],
            },
            a8 : {
                name : 'A8',
                // trims : ['3.0T Quattro 4DR Sedan AWD (3.0L 6CYL S/C 8A)', 'L 3.0T Quattro 4DR Sedan AWD (3.0L 6CYL S/C 8A)', 'L TDI Quattro 4DR Sedan AWD (3.0L 6CYL Turbodiesel 8A)', '4.0T Quattro 4DR Sedan AWD (4.0L 8CYL Turbo 8A)', 'L 4.0T Quattro 4DR Sedan AWD (4.0L 8CYL Turbo 8A)', 'L W12 Quattro 4DR Sedan AWD (6.3L 12CYL 8A)'],
            },
            allroad : {
                name : "Allroad",
                // trims : ['Premium Quattro 4DR Wagon AWD (2.0L 4CYL Turbo 8A)', 'Premium Plus Quattro 4DR Wagon AWD (2.0L 4CYL Turbo 8A)', 'Prestige Quattro 4DR Wagon AWD (2.0L 4CYL Turbo 8A)'],
            },
            q3 : {
                name : 'Q3',
                // trims : ['Premium Plus 4DR SUV (2.0L 4CYL Turbo 6A)', 'Prestige 4DR SUV (2.0L 4CYL Turbo 6A)', 'Premium Plus Quattro 4DR SUV AWD (2.0L 4CYL Turbo 6A)', 'Prestige Quattro 4DR SUV AWD (2.0L 4CYL Turbo 6A)'],
            },
            q5 : {
                name : 'Q5',
                // trims : ['2.0T Premium Quattro 4DR SUV AWD (2.0L 4CYL Turbo 8A)', '2.0T Premium Plus Quattro 4DR SUV AWD (2.0L 4CYL Turbo 8A)', '2.0T Prestige Quattro 4DR SUV AWD (2.0L 4CYL Turbo Gas/Electric)', '3.0T Premium Plus Quattro 4DR SUV AWD (3.0L 6CYL S/C 8A)', '3.0T Prestige Quattro 4DR SUV AWD (3.0L 6CYL S/C 8A)', 'TDI Premium Plus Quattro 4DR SUV AWD (3.0L 6CYL Turbodiesel 8A)', 'TDI Prestige Quattro 4DR SUV AWD (3.0L 6CYL Turbodiesel 8A)'],
            },
            q7 : {
                name : 'Q7',
                // trims : ['3.0T Premium Quattro 4DR SUV AWD (3.0L 6CYL S/C 8A)', '3.0T Premium Plus Quattro 4DR SUV AWD (3.0L 6CYL S/C 8A)', '3.0T S Line Prestige Quattro 4DR SUV AWD (3.0L 6CYL S/C 8A)', 'TDI Premium Quattro 4DR SUV AWD (3.0L 6CYL Turbodiesel 8A)', 'TDI Premium Plus Quattro 4DR SUV AWD (3.0L 6CYL Turbodiesel 8A)', 'TDI Prestige Quattro 4DR SUV AWD (3.0L 6CYL Turbodiesel 8A)'],
            },
            r8 : {
                name : 'R8',
                // trims : ['V8 Quattro 2DR Coupe AWD (4.2L 8CYL 6M)', 'V8 Quattro 2DR Coupe AWD (4.2L 8CYL 7AM)', 'V10 Quattro 2DR Coupe AWD (5.2L 10CYL 6M)', 'V10 Quattro 2DR Coupe AWD (5.2L 10CYL 7AM)', 'V10 Plus Quattro 2DR Coupe AWD (5.2L 10CYL 6M)', 'V10 Plus Quattro 2DR Coupe AWD (5.2L 10CYL 7AM)', 'V8 Quattro Spyder 2DR Convertible AWD (4.2L 8CYL 6M)', 'V8 Quattro Spyder 2DR Convertible AWD (4.2L 8CYL 7AM)', 'V10 Quattro Spyder 2DR Convertible AWD (5.2L 10CYL 6M)', 'V10 Quattro Spyder 2DR Convertible AWD (5.2L 10CYL 7AM)', 'V10 Carbon Quattro Spyder 2DR Convertible AWD (5.2L 10CYL 6M)', 'V10 Carbon Quattro Spyder 2DR Convertible AWD (5.2L 10CYL 7AM)', 'V10 Competition Quattro 2DR Coupe AWD (5.2L 10CYL 7AM)'],
            },
            rs5 : {
                name : 'RS 5',
                // trims : ['Quattro 2DR Coupe AWD (4.2L 8CYL 7AM)', 'Quattro 2DR Convertible AWD (4.2L 8CYL 7AM)'],
            },
            rs7 : {
                name : 'RS 7',
                // trims : ['Prestige Quattro 4DR Sedan AWD (4.0L 8CYL Turbo 8A)'],
            },
            s3 : {
                name : 'S3',
                // trims : ['2.0T Premium Plus Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 6AM)', '2.0T Prestige Quattro 4DR Sedan AWD (2.0L 4CYL Turbo 6AM)'],
            },
            s4 : {
                name : 'S4',
                // trims : ['Premium Plus Quattro 4DR Sedan AWD (3.0L 6CYL S/C 6M)', 'Premium Plus Quattro 4DR Sedan AWD (3.0L 6CYL S/C 7AM)', 'Prestige Quattro 4DR Sedan AWD (3.0L 6CYL S/C 6M)', 'Prestige Quattro 4DR Sedan AWD (3.0L 6CYL S/C 7AM)'],
            },
            s5 : {
                name : 'S5',
                // trims : ['Premium Plus Quattro 2DR Coupe AWD (3.0L 6CYL S/C 6M)', 'Premium Plus Quattro 2DR Coupe AWD (3.0L 6CYL S/C 7AM)', 'Prestige Quattro 2DR Coupe AWD (3.0L 6CYL S/C 6M)', 'Prestige Quattro 2DR Coupe AWD (3.0L 6CYL S/C 7AM)', 'Premium Plus Quattro 2DR Convertible AWD (3.0L 6CYL S/C 7AM)', 'Prestige Quattro 2DR Convertible AWD (3.0L 6CYL S/C 7AM)'],
            },
            s6 : {
                name : 'S6',
                // trims : ['Quattro 4DR Sedan AWD (4.0L 8CYL Turbo 7AM)'],
            },
            s7 : {
                name : 'S7',
                // trims : ['Quattro 4DR Sedan AWD (4.0L 8CYL Turbo 7AM)'],
            },
            s8 : {
                name : 'S8',
                // trims : ['Quattro 4DR Sedan AWD (4.0L 8CYL Turbo 8A)'],
            },
            sq5 : {
                name : 'SQ5',
                // trims : ['3.0T Premium Plus Quattro 4DR SUV AWD (3.0L 6CYL S/C 8A)', '3.0T Prestige Quattro 4DR SUV AWD (3.0L 6CYL S/C 8A)'],
            },
            tt : {
                name : 'TT',
                // trims : ['2.0T Quattro 2DR Coupe AWD (2.0L 4CYL Turbo 6AM)', '2.0T Quattro 2DR Convertible AWD (2.0L 4CYL Turbo 6AM)'],
            },
            tts : {
                name : 'TTS',
                // trims : ['Quattro 2DR Convertible AWD (2.0L 4CYL Turbo 6AM)', 'Quattro 2DR Coupe AWD (2.0L 4CYL Turbo 6AM)'],
            },
        },
        bently_models : {
            continental : {
                name : 'Continental GT',
                // trims : ['2DR Coupe AWD (6.0L 12CYL Turbo 8A)', 'V8 2DR Coupe AWD (4.0L 8CYL Turbo 8A)', 'V8 S 2DR Coupe AWD (4.0L 8CYL Turbo 8A)', 'V8 2DR Convertible AWD (4.0L 8CYL Turbo 8A)', '2DR Convertible AWD (6.0L 12CYL Turbo 8A)', 'V8 S 2DR Convertible AWD (4.0L 8CYL Turbo 8A)', 'Speed 2DR Coupe AWD (6.0L 12CYL Turbo 8A)', 'Speed 2DR Convertible AWD (6.0L 12CYL Turbo 8A)'],
            },
            flying_spur : {
                name : 'Flying Spur',
                // trims : ['4DR Sedan AWD (6.0L 12CYL Turbo 8A)', '4DR Sedan AWD (4.0L 8CYL Turbo 8A)'],
            },
            mulsanne : {
                name : 'Mulsanne',
                // trims : ['4DR Sedan (6.8L 8CYL Turbo 8A)'],
            },
        },
        bmw_models : {
            _2_series : {
                name : '2 Series',
                // trims : ['228i 2DR Convertible (2.0L 4CYL Turbo 8A)', '228i 2DR Coupe (2.0L 4CYL Turbo 8A)', '228i SULEV 2DR Coupe (2.0L 4CYL Turbo 8A)', '228i xDrive SULEV 2DR Coupe AWD (2.0L 4CYL Turbo 8A)', '228i xDrive 2DR Coupe AWD (2.0L 4CYL Turbo 8A)', 'M235i 2DR Coupe (3.0L 6CYL Turbo 8A)', 'M235i xDrive 2DR Coupe AWD (3.0L 6CYL Turbo 8A)'],
            },
            _3_series : {
                name : '3 Series',
                // trims : ['320i 4DR Sedan (2.0L 4CYL Turbo 8A)', '320i xDrive 4DR Sedan AWD (2.0L 4CYL Turbo 8A)', '328i 4DR Sedan (2.0L 4CYL Turbo 8A)', '328i SULEV 4DR Sedan (2.0L 4CYL Turbo 8A)', '328i xDrive 4DR Sedan AWD (2.0L 4CYL Turbo 8A)', '328i xDrive SULEV 4DR Sedan AWD (2.0L 4CYL Turbo 8A)', '328d 4DR Sedan (2.0L 4CYL Turbodiesel 8A)', '328d xDrive 4DR Sedan AWD (2.0L 4CYL Turbodiesel 8A)', '335i 4DR Sedan (3.0L 6CYL Turbo 8A)', '335i xDrive 4DR Sedan AWD (3.0L 6CYL Turbo 8A)', 'ActiveHybrid 3 4DR Sedan (3.0L 6CYL Turbo Gas/Electric Hybrid 8A', '328i xDrive 4DR Wagon AWD (2.0L 4CYL Turbo 8A)', '328d xDrive 4DR Wagon AWD (2.0L 4CYL Turbodiesel 8A)', '228i xDrive 2DR Convertible AWD (2.0L 4CYL Turbo 8A)', 'M235i 2DR Convertible (3.0L 6CYL Turbo 8A)']
            },
            _3_series_gran_turismo : {
                name : '3 Series Gran Turismo',
                // trims : ['328i xDrive 4DR Hatchback AWD (2.0L 4CYL Turbo 8A)', '328i xDrive SULEV 4DR Hatchback AWD (2.0L 4CYL Turbo 8A)', '335i xDrive 4DR Hatchback AWD (3.0L 6CYL Turbo 8A)'], 
            },
            _4_series : {
                name : '4 Series',
                // trims : ['428i 2DR Coupe (2.0L 4CYL Turbo 8A)', '435i 2DR Coupe (3.0L 6CYL Turbo 8A)', '435i xDrive 2DR Coupe AWD (3.0L 6CYL Turbo 8A)', '428i 2DR Convertible (2.0L 4CYL Turbo 8A)', '428i SULEV 2DR Convertible (2.0L 4CYL Turbo 8A)', '428i xDrive 2DR Convertible AWD (2.0L 4CYL Turbo 8A)', '428i xDrive SULEV 2DR Convertible AWD (2.0L 4CYL Turbo 8A)', '435i 2DR Convertible (3.0L 6CYL Turbo 8A)', '435i xDrive 2DR Convertible AWD (3.0L 6CYL Turbo 8A)', '428i SULEV 2DR Coupe (2.0L 4CYL Turbo 8A)', '428i xDrive 2DR Coupe AWD (2.0L 4CYL Turbo 8A)', '428i xDrive SULEV 2DR Coupe AWD (2.0L 4CYL Turbo 8A)'],
            },
            _4_series_gran_coupe : {
                name : '4 Series Gran Coupe',
                // trims : ['435i xDrive 4DR Sedan AWD (3.0L 6CYL Turbo 8A)', '428i SULEV 4DR Sedan (2.0L 4CYL Turbo 8A)', '435i 4DR Sedan (3.0L 6CYL Turbo 8A)', '428i xDrive SULEV 4DR Sedan AWD (2.0L 4CYL Turbo 8A)', '428i xDrive 4DR Sedan AWD (2.0L 4CYL Turbo 8A)', '428i 4DR Sedan (2.0L 4CYL Turbo 8A)']
            },
            _5_series : {
                name : '5 Series',
                // trims : ['528i 4DR Sedan (2.0L 4CYL Turbo 8A)', '528i xDrive 4DR Sedan AWD (2.0L 4CYL Turbo 8A)', '535i 4DR Sedan (3.0L 6CYL Turbo 8A)', '535i xDrive 4DR Sedan AWD (3.0L 6CYL Turbo 8A)', '535d 4DR Sedan (3.0L 6CYL Turbodiesel 8A)', '535d xDrive 4DR Sedan AWD (3.0L 6CYL Turbodiesel 8A)', '550i 4DR Sedan (4.4L 8CYL Turbo 8A)', '550i xDrive 4DR Sedan AWD (4.4L 8CYL Turbo 8A)'],
            },
            _5_series_gran_tursimo : {
                name : '5 Series Gran Turismo',
                // trims : ['535i 4DR Hatchback (3.0L 6CYL Turbo 8A)', '535i xDrive 4DR Hatchback AWD (3.0L 6CYL Turbo 8A)', '550i 4DR Hatchback (4.4L 8CYL Turbo 8A)', '550i xDrive 4DR Hatchback AWD (4.4L 8CYL Turbo 8A)'],
            },
            _6_series : {
                name : '6 Series',
                // trims : ['650i xDrive 2DR Convertible AWD (4.4L 8CYL Turbo 8A)', '640i 2DR Coupe (3.0L 6CYL Turbo 8A)', '640i xDrive 2DR Coupe AWD (3.0L 6CYL Turbo 8A)', '650i 2DR Coupe AWD (4.4L 8CYL Turbo 8A)', '650i xDrive 2DR Coupe AWD (4.4L 8CYL Turbo 8A)', '640i 2DR Convertible (3.0L 6CYL Turbo 8A)', '640i xDrive 2DR Convertible AWD (3.0L 6CYL Turbo 8A)', '650i 2DR Convertible (4.4L 8CYL Turbo 8A)']
            },
            _6_series_gran_coupe : {
                name : '6 Series Gran Coupe',
                // trims : ['640i xDrive 4DR Sedan AWD (3.0L 6CYL Turbo 8A)', '650i 4DR Sedan (4.4L 8CYL Turbo 8A)', '650i xDrive 4DR Series AWD (4.4L 8CYL Turbo 8A)', '640i 4DR Sedan (3.0L 6CYL Turbo 8A)'],
            },
            _7_series : {
                name : '7 Series',
                // trims : ['740LD xDrive 4DR Sedan AWD (3.0L 6CYL Turbodiesel 8A)', '740i 4DR Sedan (3.0L 6CYL Turbo 8A)', '740Li xDrive 4DR Sedan AWD (3.0L 6CYL Turbo 8A)', '750i 4DR Sedan (4.4L 8CYL Turbo 8A)', '740Li 4DR Sedan (3.0L 6CYL Turbo 8A)', '750Li 4DR Sedan (4.4L 8CYL Turbo 8A)', '750Li xDrive 4DR Sedan AWD (4.4L 8CYL Turbo 8A)', '750i xDrive 4DR Sedan AWD (4.4L 8CYL Turbo 8A)', '760Li 4DR Sedan (6.0L 12CYL Turbo 8A)'],
            },
            active_hybrid_5 : {
                name : 'ActiveHybrid 5',
                // trims : ['4DR Sedan (3.0L 6CYL Turbo Gas/Electric Hybrid 8A)'],
            },
            active_hybrid_7 : {
                name : 'ActiveHybrid 7',
                // trims : ['740Li 4DR Sedan (3.0L 6CYL Turbo Gas/Electric Hybrid 8A)'],
            },
            alpina_b6_gran_coupe : {
                name : 'ALPINA B6 Gran Coupe',
                // trims : ['xDrive 4DR Sedan AWD (4.4L 8CYL Turbo 8A)']
            },
            alpina_b7 : {
                name : 'ALPINA B7',
                // trims : ['SWB 4DR Sedan (4.4L 8CYL Turbo 8A)', 'LWB 4DR Sedan AWD (4.4L 8CYL Turbo 8A)', 'SWB xDrive 4DR Sedan AWD (4.4L 8CYL Turbo 8A)', 'LWB xDrive 4DR Sedan AWD (4.4L 8CYL Turbo 8A)'],
            },
            m3 : {
                name : 'M3',
                // trims : ['4DR Sedan (3.0L 6CYL Turbo 6M)'],
            },
            m4 : {
                name : 'M4',
                // trims : ['2DR Coupe (3.0L 6CYL Turbo 6M)', '2DR Convertible (3.0L 6CYL Turbo 6M)']
            },
            m5 : {
                name : 'M5',
                // trims : ['4DR Sedan (4.4L 8CYL Turbo 7AM)']
            },
            m6 : {
                name : 'M6',
                // trims : [],
            },
            m6_gran_coupe : {
                name: 'M6 Gran Coupe',
            },
            x1 : {
                name : 'X1',
            },
            x3 : {
                name : 'X3',
            },
            x4 : {
                name : 'X4',
            },
            x5 : {
                name : 'X5',
            },
            x6 : {
                name : 'X6',
            },
            z4 : {
                name : 'Z4',
            },
        },
        buick_models : {
            enclave : {
                name : 'Enclave',
            },
            encore : {
                name : 'Encore',
            },
            lacrosse : {
                name : 'LaCrosse',
            },
            regal : {
                name : 'Regal',
            },
            verano : {
                name : 'Verano',
            },
        },
        cadillac_models : {
            ats : {
                name : 'ATS',
            },
            ats_coupe : {
                name : 'ATS Coupe',
            },
            cts : {
                name : 'CTS',
            },
            cts_v : {
                name : 'CTS-V Coupe',
            },
            escalade : {
                name : 'Escalade',
            },
            esv : {
                name : 'Escalade ESV',
            },
            srx : {
                name : 'SRX'
            },
            xts : {
                name : 'XTS',
            },
        },
        chevrolet_models : {
            camaro : {
                name : 'Camaro',
            },
            city_express : {
                name : 'City Express',
            },
            colorado : {
                name : 'Colorado',
            },
            corvette : {
                name : 'Corvette',
            },
            cruze : {
                name : 'Cruze',
            },
            equinox : {
                name : 'Equinox',
            },
            express : {
                name : 'Express',
            },
            express_cargo : {
                name : 'Express Cargo',
            },
            impala : {
                name : 'Impala',
            },
            malibu : {
                name : 'Malibu',
            },
            silverado_1500 : {
                name : 'Silverado 1500',
            },
            silverado_2500 : {
                name : 'Silverado 2500HD',
            },
            silverado_3500 : {
                name : 'Silverado 3500HD',
            },
            sonic : {
                name : 'Sonic',
            },
            spark : {
                name : 'Spark',
            },
            spark_ev : {
                name : 'Spark EV',
            },
            suburban : {
                name : 'Suburban',
            },
            tahoe : {
                name : 'Tahoe',
            },
            traverse : {
                name : 'Traverse',
            },
            trax : {
                name : 'Trax',
            },
            volt : {
                name : 'Volt',
            },
        },
        chrysler_models : {
            _200 : {
                name : '200',
            },
            _300 : {
                name : '300',
            },
            town_country : {
                name : 'Town & Country',
            },
        },
        dodge_models : {
            challenger : {
                name : 'Challenger',
            },
            charger : {
                name : 'Charger',
            },
            dart : {
                name : 'Dart',
            },
            durango : {
                name : 'Durango',
            },
            grand_caravan : {
                name : 'Grand Caravan',
            },
            journey : {
                name : 'Journey',
            },
            srt_viper : {
                name : 'SRT Viper',
            },
        },
        fiat_models : {
            _500 : {
                name : '500',
            },
            _500_e : {
                name : '500 E',
            }
        },
        ford_models : {
            cmax_e : {
                name : 'C-Max Energi',
            },
            cmax_h : {
                name : 'C-Max Hybrid',
            },
            edge : {
                name : 'Edge',
            },
            escape : {
                name : 'Escape',
            },
            expedition : {
                name : 'Expedition',
            },
            explorer : {
                name : 'Explorer',
            },
            f_150 : {
                name : 'F-150',
            },
            f_250 : {
                name : 'F-250 Super Duty',
            },
            f_350 : {
                name : 'F-350 Super Duty',
            },
            f_450 : {
                name : 'F-450 Super Duty',
            },
            fiesta : {
                name : 'Fiesta',
            },
            flex : {
                name : 'Flex',
            },
            focus : {
                name : 'Focus',
            },
            focus_st : {
                name : 'Focus ST'
            },
            fusion : {
                name : 'Fusion',
            },
            fusion_e : {
                name : 'Fusion Energi',
            },
            fusion_h : {
                name : 'Fusion Hybrid',
            },
            mustang : {
                name : 'Mustang',
            },
            taurus : {
                name : 'Taurus',
            },
            transit_c : {
                name : 'Transit Connect',
            },
            transit_v : {
                name : 'Transit Van',
            },
            transit_w : {
                name : 'Transit Wagon',
            },
        },
        gmc_models : {
            acadia : {
                name : 'Acadia',
            },
            canyon : {
                name : 'Canyon',
            },
            savana : {
                name : 'Savana',
            },
            sierra_1500 : {
                name : 'Siera 1500',
            },
            sierra_2500 : {
                name : 'Sierra 2500HD',
            },
            sierra_3500 : {
                name : 'Sierra 3500HD',
            },
            terrain : {
                name : 'Terrain',
            },
            yukon : {
                name : 'Yukon',
            },
            yukon_xl : {
                name : 'Yukon XL',
            },
        },
        honda_models : {
            accord : {
                name : 'Accord',
            },
            accord_h : {
                name : 'Accord Hybrid',
            },
            civic : {
                name : 'Civic',
            },
            cr_v : {
                name : 'CR-V',
            },
            cr_z : {
                name : 'CR-Z',
            },
            crosstour : {
                name : 'Crosstour',
            },
            fit : {
                name : 'Fit',
            },
            odyssey : {
                name : 'Odyssey',
            },
            pilot : {
                name : 'Pilot',
            },
        },
        hyundai_models : {
            accent : {
                name : 'Accent',
            },
            azera : {
                name : 'Azera',
            },
            elantra : {
                name : 'Elantra',
            },
            equus : {
                name : 'Equus',
            },
            genesis : {
                name : 'Genesis',
            },
            genesis_c : {
                name : 'Genesis C',
            },
            santa_fe : {
                name : 'Santa Fe',
            },
            santa_fe_s : {
                name : 'Santa Fe Sport',
            },
            sonata : {
                name : 'Sonata',
            },
            sonata_h : {
                name : 'Sonata Hybrid',
            },
            tucson : {
                name : 'Tucson',
            },
            veloster : {
                name : 'Veloster',
            },
        },
        infinit_models : {
            q4 : {
                name : 'Q40',
            },
            q5 : {
                name : 'Q50',
            },
            q6_coupe : {
                name : 'Q60 Coupe',
            },
            q6_conv : {
                name : 'Q60 Convertible',
            },
            qx5 : {
                name : 'QX50',
            },
            qx7 : {
                name : 'QX70',
            },
            qx8 : {
                name : 'QX80',
            },
        },
        jaguar_models : {
            f_type : {
                name : 'F-TYPE',
            },
            xf : {
                name : 'XF',
            },
            xj : {
                name : 'XJ',
            },
            xk : {
                name : 'XK',
            },
        },
        jeep_models : {
            cherokee : {
                name : 'Cherokee',
            },
            compass: {
                name : 'Compass',
            },
            grand_cherokee : {
                name : 'Grand Cherokee',
            },
            grand_cherokee_srt : {
                name : 'Grand Cherokee SRT',
            },
            patriot : {
                name : 'Patriot',
            },
            renegade : {
                name : 'Renegade',
            },
            wrangler : {
                name : 'Wrangler',
            },
        },
        kia_models : {
            cadenza : {
                name : 'Cadenza',
            },
            forte : {
                name : 'Forte',
            },
            k9 : {
                name : 'K900',
            },
            optima : {
                name : 'Optima',
            },
            optima_h : {
                name : 'Optima Hybrid',
            },
            rio : {
                name : 'Rio',
            },
            sedona : {
                name : 'Sedona',
            },
            soul : {
                name : 'Soul',
            },
            soul_ev : {
                name : 'Soul EV',
            },
            sorent : {
                name : 'Sorento',
            },
            sportage : {
                name : 'Sportage',
            },
        },
        lamborghini_models : {
            aventador : {
                name : 'Aventador',
            },
            huracan : {
                name : 'Huracan',
            }
        },
        land_rover_models : {
            discovery : {
                name : 'Discovery Sport',
            },
            lr2 : {
                name : 'LR2',
            },
            lr4 : {
                name : 'LR4',
            },
            range_rover : {
                name : 'Range Rover',
            },
            range_rover_e : {
                name : 'Range Rover Evoque',
            },
            range_rover_e_conv : {
                name : 'Range Rover Evoque Convertible',
            },
            range_rover_s : {
                name : 'Range Rover Sport',
            },
        },
        lexus_models : {
            ct_2 : {
                name : 'CT 200h',
            },
            gx_4 : {
                name : 'GX 460',
            },
            es_3 : {
                name : 'ES 300h',
            },
            es_35 : {
                name : 'ES 350',
            },
            gs_3 : {
                name : 'GS 350',
            },
            gs_4 : {
                name : 'GS 400h',
            },
            is_2 : {
                name : 'IS 250',
            },
            is_2c : {
                name : 'IS 250 C',
            },
            is_3 : {
                name : 'IS 350',
            },
            is_3c : {
                name : 'IS 350 C',
            },
            ls_4 : {
                name : 'LS 460',
            },
            ls_6 : {
                name : 'LS 600h L'
            },
            lx_5 : {
                name : 'LX 570',
            },
            mx_3 : {
                name : 'MX 300h',
            },
            nx_2 : {
                name : 'NX 200t',
            },
            nx_3 : {
                name : 'NX 300h',
            },
            rc_3 : {
                name : 'RC 350',
            },
            rc_f : {
                name : 'RC F',
            },
            rx_3 : {
                name : 'RX 350',
            },
            rx_4 : {
                name : 'RX 450h',
            },
        },
        lincoln_models : {
            mkc : {
                name : 'MKC',
            },
            mks : {
                name : 'MKS',
            },
            mkt : {
                name : 'MKT',
            },
            mkx : {
                name : 'MKX',
            },
            mkz : {
                name : 'MKZ',
            },
            navigator : {
                name : 'Navigator',
            },
        },
        maserati_models : {
            ghibli : {
                name : 'Ghibli',
            },
            granturismo : {
                name : 'GranTurismo',
            },
            granturismo_conv : {
                name : 'GranTurismo Convertible',
            },
            quattroporte : {
                name : 'Quattroporte',
            },
        },
        mazda_models : {
            cx_5 : {
                name : 'CX-5',
            },
            cx_9 : {
                name : 'CX-9',
            },
            mazda3 : {
                name : 'Mazda3',
            },
            mazad5 : {
                name : 'Mazda5',
            },
            mazda6 : {
                name : 'Mazda6',
            },
            mx_5 : {
                name : 'MX-5 Miata',
            },
        },
        mclaren_models : {
            _650s_c : {
                name : '650S Coupe',
            },
            _650s_s : {
                name : '650S Spider',
            },
            p1 : {
                name : 'P1',
            },
        },
        mercedes_models : {
            c : {
                name : 'C-Class',
            },
            cls : {
                name : 'CLS-Class',
            },
            e : {
                name : 'E-Class',
            },
            g : {
                name : 'G-Class',
            },
            gl : {
                name : 'GL-Class',
            },
            gla : {
                name : 'GLA-Class',
            },
            glk : {
                name : 'GLK-Class',
            },
            m : {
                name : 'M-Class',
            },
            s : {
                name : 'S-Class',
            },
            sl : {
                name : 'SL-Class',
            },
            slk : {
                name : 'SLK-Class',
            },
            sls : {
                name : 'SLS AMG GT Final Edition',
            },
        },
        mini_models : {
            cooper : {
                name : 'Cooper',
            },
            cooper_country : {
                name : 'Cooper Countryman',
            },
            cooper_coupe : {
                name : 'Cooper Coupe',
            },
            cooper_pace : {
                name : 'Cooper Paceman',
            },
            cooper_roadster : {
                name : 'Cooper Roadster'
            },
        },
        mitsubishi_models : {
            lancer : {
                name : 'Lancer',
            },
            lancer_e : {
                name : 'Lancer Evolution',
            },
            mirage : {
                name : 'Mirage',
            },
            outlander : {
                name : 'Outlander',
            },
            outlander_s : {
                name : 'Outlander Sport',
            },
        },
        nissan_models : {
            _370z : {
                name : '370Z',
            },
            altima : {
                name : 'Altima',
            },
            armada : {
                name : 'Armada',
            },
            frontier : {
                name : 'Frontier',
            },
            gtr : {
                name : 'GT-R',
            },
            juke : {
                name : 'Juke',
            },
            leaf : {
                name : 'Leaf',
            },
            murano : {
                name : 'Murano',
            },
            nv200 : {
                name : 'NV200',
            },
            pathfinder : {
                name : 'Pathfinder',
            },
            quest : {
                name : 'Quest',
            },
            rogue : {
                name : 'Rogue',
            },
            sentra : {
                name : 'Sentra',
            },
            versa : {
                name : 'Versa',
            },
            versa_n : {
                name : 'Versa Note',
            },
            xterra : {
                name : 'Xterra',
            },
        },
        porsche_models : {
            _911 : {
                name : '911',
            },
            _918_s : {
                name : '918 Spyder',
            },
            boxster : {
                name : 'Boxster',
            },
            cayman : {
                name : 'Cayman',
            },
            cayenne : {
                name : 'Cayenne',
            },
            macan : {
                name : 'Macan',
            },
            panamera : {
                name : 'Panamera',
            },
        },
        ram_models : {
            _1500 : {
                name : '1500',
            },
            _2500 : {
                name : '2500',
            },
            _3500 : {
                name : '3500',
            },
            cv : {
                name : 'CV Tradesman',
            },
            promaster_cargo : {
                name : 'ProMaster Cargo Van',
            },
            promaster_city : {
                name : 'ProMaster City',
            },
            promaster_window : {
                name : 'ProMaster Window Van',
            },
        },
        rolls_models : {
            ghost : {
                name : 'Ghost Series II',
            },
        },
        scion_models : {
            fr_s : {
                name : 'FR-S',
            },
            iq : {
                name : 'iQ',
            },
            tc : {
                name : 'tC',
            },
            xb : {
                name : 'xB',
            },
        },
        smart_models : {
            fortwo : {
                name : 'fortwo',
            },
        },
        subaru_models : {
            brz : {
                name : 'BRZ',
            },
            forester : {
                name : 'Forester',
            },
            impreza : {
                name : 'Impreza',
            },
            legacy : {
                name : 'Legacy',
            },
            outback : {
                name : 'Outback',
            },
            wrx : {
                name : 'WRX',
            },
            xv : {
                name : 'XV Crosstrek',
            },
        },
        toyota_models : {
            _4runner : {
                name : '4Runner',
            },
            avalon : {
                name : 'Avalon',
            },
            avalon_h : {
                name : 'Avalon Hybrid',
            },
            camry : {
                name : 'Camry',
            },
            camry_h : {
                name : 'Camry Hybrid',
            },
            corolla : {
                name : 'Corolla',
            },
            highlander : {
                name : 'Highlander',
            },
            highlander_h : {
                name : 'Highlander Hybrid',
            },
            land_cruiser : {
                name : 'Land Cruiser',
            },
            prius : {
                name : 'Prius',
            },
            prius_c : {
                name : 'Prius C',
            },
            prius_v : {
                name : 'Prius V',
            },
            prius_p : {
                name : 'Prius Plug-In',
            },
            rav4 : {
                name : 'RAV4',
            },
            sequoia : {
                name : 'Sequoia',
            },
            sienna : {
                name : 'Sienna',
            },
            tacoma : {
                name : 'Tacoma',
            },
            tundra : {
                name : 'Tundra',
            },
            venza : {
                name : 'Venza',
            },
            yarris : {
                name : 'Yarris',
            },
        },
        volkswagen_models : {
            beetle : {
                name : 'Beetle',
            },
            beetle_c : {
                name : 'Beetle Convertible',
            },
            cc : {
                name : 'CC',
            },
            e_golf : {
                name : 'e-Golf',
            },
            eos : {
                name : 'Eos',
            },
            golf : {
                name : 'Golf',
            },
            golf_gti : {
                name : 'Golf GTI',
            },
            golf_r : {
                name : 'Golf R',
            },
            golf_sport : {
                name : 'Golf SportWagen',
            },
            jetta : {
                name : 'Jetta',
            },
            passat : {
                name : 'Passat',
            },
            tiguan : {
                name : 'Tiguan',
            },
        },
        volvo_models : {
            s6 : {
                name : 'S60',
            },
            s8 : {
                name : 'S80',
            },
            v6 : {
                name : 'V60',
            },
            v6_c : {
                name : 'V60 Cross Country',
            },
            xc6 : {
                name : 'XC60',
            },
            xc7 : {
                name : 'XC70',
            },
        },
    }
    // setup event listener for selection of any viable option from the make field
    $('#make-field').change(function() {
        // enable the #model-field select element
        $('#model-field').prop({'disabled' : false});
        $('#model-field').html('');
        // grab the car model from the select option chosen from the #make-field input
        var data_key = $('#make-field option:selected').data('model-key');
        // create the necessary attributes for the new option created in the #model-field dropdown
        var option_html;
        var option_id;
        var option_make_key;
        var option_value;
        // use the car model as a key to loop through the 'car_models' object and pull out models based on selected make
        var model_keys = Object.keys(car_models);
        for (var model_key of model_keys) {
            if (data_key == model_key) {
                var make_keys = Object.keys(car_models[model_key]);
                for (var make_key of make_keys) {
                    option_id = option_make_key = make_key;
                    option_html = option_value = car_models[model_key][make_key]['name'];
                    if (option_id.startsWith('_')) {
                        option_id = option_id.substring(1, option_id.length);
                    }
                    $('#model-field').append(`<option id=${option_id} value="` + option_value + `" data-make-key=${option_make_key}>${option_html}</option>`);
                }
            }
        }
    });

    // ------------------------------
    // Form validation and processing
    // ------------------------------
    // Form validation and submission through AJAX call
    $('.form-submit').click(function(e) {
        e.preventDefault();
        // Grab the form 'id' and data key
        var form_id = $(this).parent().attr('id');
        // Initialize the loading wheel animation
        $(`#${form_id} .loading-icon`).show();
        // Grab the field data from the form
        var form_fields = [];
        // Loop through the fields of the form and create an array of its field ids and values
        $(`#${form_id} .form-input`).each(function(i) {
            form_fields[i] = {
                id      : $(this).attr('id'),
                value   : $(this).val(),
                label   : $(this).data('email-label'),
            }
        });
        // Create a JSON object for the forms data
        var form_data = {
            form_id : form_id,
            form_fields : form_fields,
        }
        // If the form is the 'featured-partner' form, include the partner's email to set for notification forwarding
        if (form_id == 'featured-partner-form') {
            form_data['partner_email'] = $(`#${form_id}`).data('partner-email');
            form_data['account_number'] = $(`#${form_id}`).data('account-number');
        }
        // AJAX call to send the form data and retrieve response from the form processor script
        $.ajax({
            type : 'POST',
            url : ajax.url,
            dataType : 'JSON',
            data : {
                action : 'form_processor',
                form_data : form_data,
            },
            success : function(response) {
                $(`#${form_id} .loading-icon`).hide();
                if (response.flag == true) {
                    $(`#${form_id} .form-input`).removeClass('error-field');
                    console.log('There are errors in the form!');
                    console.log(response.error_msg);
                    var invalid_fields = Object.keys(response.invalid_fields);
                    for (var field of invalid_fields) {
                        var field_id = response.invalid_fields[field].replace('_', '-');
                        $(`#${form_id} #${field_id}`).addClass('error-field');
                        $(`#${form_id} .form-header`).html(response.error_msg);
                    }
                }
                else {
                    if (form_id == 'contact-form') {
                        window.location.replace('http://www.autoloancalculators.com/contact-us/thank-you');
                    }
                    else {
                        $(`#${form_id}`).parent().parent().removeClass('active');
                    }
                }
            }
        })
    });
});