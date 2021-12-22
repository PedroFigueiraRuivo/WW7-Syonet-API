function PFR_SC__runTheAjax(){

    function PFR_SC__getSelect( typeData ){

        let divToSelect;
        let isVehicle = false;

        if( typeof( typeData ) == 'object' ){
            divToSelect = document.querySelector( '#ww7syonetapi_city select' );
        }else if( typeof( typeData ) == 'string' && typeData === 'vehicle' ){
            divToSelect = document.querySelector( '#ww7syonetapi_vehicle select' );
            isVehicle = true;
        }
        
        let divToSelectCity = divToSelect.options[divToSelect.selectedIndex].innerText;

        if( isVehicle ){
            if( divToSelectCity == '---' || divToSelectCity == null || divToSelectCity == '' ){
                return null;
            }
            return divToSelectCity;
        }

        let idCity = null;
        
        for( let II = 0; II < typeData.length; II++ ){
            if( divToSelectCity.toLowerCase().includes( typeData[II] ) ){
                idCity = II + 2;
            }
        }

        if( idCity != null ){
            return idCity.toString();
        }else{
            return idCity;
        }
    }

    function PFR_SC__getTheNumber( typeData ){
        function clear( theMasc ){
            let newNumber, theLieNumber = 0;

            if( theMasc && theMasc != '' && theMasc != null ){
                newNumber = parseInt( theMasc );
                return newNumber;
            }else{
                newNumber = theLieNumber;
                return newNumber;
            }

        }

        function validNumber( value, process ){
            let theReturn = null;
            
            if( process === 'ddd' ){
                if( value > 10 && value < 100 ){
                    theReturn = value;
                }
            }else{
                if( ( value.toString() ).length == 9 ){
                    theReturn = value;
                }
            }
            return theReturn;
        }

        let divToNumber;

        if( typeData == 'ddd' ){
            divToNumber = document.querySelector( '#ww7syonetapi_ddd input' );
        }else if( typeData === 'cellphone' ){
            divToNumber = document.querySelector( '#ww7syonetapi_cellphone input' );
        }
        
        if( ( validNumber ( clear( divToNumber.value ), typeData ) ) != null ){
            return ( validNumber ( clear( divToNumber.value ), typeData ) ).toString();
        }else{
            return null;
        }

    }

    function PFR_SC__getTheContent( value ){
        let divToText;

        if( value === 'name' ){
            divToText = document.querySelector( '#ww7syonetapi_name input' );
        }else if( value === 'subject' ){
            divToText = document.querySelector( '#ww7syonetApi_subject input' );
        }else if( value === 'message' ){
            divToText = document.querySelector( '#ww7syonetapi_message textarea' );
        }

        let theText = divToText.value;

        if( theText && theText != '' && theText != null ){
            return theText;
        }else{
            
            theText = null;
            
            return theText;
        }
    }

    let idEmpresa = PFR_SC__getSelect( [ 'caruaru', 'petrolina' ] );
    let vehicle = PFR_SC__getSelect( 'vehicle' );

    let nameUser = PFR_SC__getTheContent( 'name' );
    let theMensage = PFR_SC__getTheContent( 'message' );

    let theCellphone = PFR_SC__getTheNumber( 'cellphone' );
    let theDDD = PFR_SC__getTheNumber( 'ddd' );

    let arrToAlert = [ idEmpresa, theDDD, theCellphone, vehicle, nameUser ];
    let arrVarstNames = [ 'Cidade', 'DDD', 'Telefone', 'Veículo', 'Nome' ];
    let arrToAlertNames = [];
    let itensAlert = [];
    let validate = 0;

    for( let II = 0; II < arrToAlert.length; II++ ){
        if( arrToAlert[ II ] == null ){
            arrToAlertNames[ II ] = arrVarstNames[ II ];
            validate++;
        }
    }

    for( let II = 0; II < arrToAlertNames.length; II++ ){
        if( arrToAlert[ II ] == null ){
            itensAlert += '\n' + arrToAlertNames[ II ];
        }
    }

    if( validate == 0 ){

        (function( $ ){

            $.ajax({
                url: script_ajax.ajax_url,
                type: "POST",
                dataType: "JSON",
                data: {
                    action: 'getData_ajax',
                    'idEmpresa': idEmpresa,
                    'vehicle': vehicle,
                    'nameUser': nameUser,
                    'theMensage': theMensage,
                    'theCellphone': theCellphone,
                    'theDDD': theDDD
                },
                success: ( data ) => data.status == 1 ? console.log( 'Sucesso ' + data.msg ) : console.log( 'Sucesso ' + data.msg ),
                error: ( response ) => console.error( 'Error: ' + response ),
            });
            
        })( jQuery );
        
    }else{
        alert( 'WW7 - Syonet API: \nO formulário não será enviado por falta de compo preenchido ou por campos preenchidos de forma incorreta. \n\nITENS:\n ' + itensAlert );
        location.reload();
    }
}