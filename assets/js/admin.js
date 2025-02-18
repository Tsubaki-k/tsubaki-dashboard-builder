var survey_options  = document.getElementById('survey_options');
var add_more_fields = document.getElementById('add_more_fields');
var remove_fields   = document.getElementById('remove_fields');



add_more_fields.onclick = function(){

    var TDC = document.getElementsByClassName('tabs-data-container');
    var turnTDCToEntries = Object.entries(TDC);
    var getTDCTlength = turnTDCToEntries.length - 2;

    if( getTDCTlength !== -1 ){
        var getSecondToLastNumber = TDC[ getTDCTlength ].id.split('-')[1];
        var getNextIdNumber = parseInt(getSecondToLastNumber) + 1;
    }else{
        var getNextIdNumber = 1;
    }


    // if( getNextIdNumber >= 150){
    //     return;
    // }

    console.log( getSecondToLastNumber );

    var elem = document.querySelector('#elem1');
    var clone = elem.cloneNode(true);
    clone.id = 'tab-' + getNextIdNumber;
    clone.classList.add('must-show');
    // var childClone = clone.child;

    const allChildElement = [...clone.querySelectorAll('.tabs-field-container')];

    allChildElement.forEach((e) => {
        var tabsInput = e.querySelector('.tabs-field-input');
        tabsInput.name += getNextIdNumber + '][' + tabsInput.getAttribute('data-type') + ']';

        if( !tabsInput.classList.contains('tab-link') || !tabsInput.classList.contains('tab-shortcode')  ){
            tabsInput.required = true;
        }

    });
    document.body.append(clone);

    // console.log(childClone);
    elem.before(clone);

}

function deleteTabField(elem){
    var idOfParent = elem.parentNode.id;
    var getParent = document.getElementById( idOfParent );
    getParent.remove();

}

// remove_fields.onclick = function(){
//     var input_tags = survey_options.getElementsByTagName('input');
//     if(input_tags.length > 2) {
//         survey_options.removeChild(input_tags[(input_tags.length) - 1]);
//     }
// }