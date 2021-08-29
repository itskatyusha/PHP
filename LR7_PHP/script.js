
const form = document.getElementById('form');

//при отправке формы переходим в функцию formSend
form.addEventListener('submit', formSend);

async function formSend(e) {
    e.preventDefault();
    
    var key = '';
    var input_address = document.getElementById('input_address').value;

    $.ajax({
        url: "https://geocode-maps.yandex.ru/1.x/?apikey=" + key + "&format=json&geocode=" + input_address,
        success: function (result) {
            var full_address = result.response.GeoObjectCollection.featureMember[0].GeoObject.metaDataProperty.GeocoderMetaData.text;
            $('#address').html(full_address);

            var coordinates = result.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos;
            $('#coordinates').html(coordinates);
            $.ajax({
                url: "https://geocode-maps.yandex.ru/1.x/?apikey=" + key + "&format=json&geocode=" + coordinates + "&kind=metro&results=1",
                success: function (result) {
                    var subway = result.response.GeoObjectCollection.featureMember[0].GeoObject.metaDataProperty.GeocoderMetaData.text;
                    $('#subway').html(subway);
                }
            });
        }
    });
}