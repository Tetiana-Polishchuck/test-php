
$(document).ready(function() {
    init();
});


$('#product_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var name = button.data('name');
    var price = button.data('price');
    var quantity = button.data('quantity');
    var modal = $(this);
    modal.find('.modal-title').text(name);
    modal.find('.product_price').text(price + ' грн.');
    modal.find('.product_quantity').text(quantity);
});


function display_gategory(id) {
    toggleLoader(true);
    const url = updateUrlParameter('category_id', id);
    makeRequest(url);
}

function updateUrlParameter(param, value) {
    const url = new URL(window.location);
    if (value) {
        url.searchParams.set(param, value);
    } else {
        url.searchParams.delete(param);
    }
    window.history.pushState({}, '', url);
    return url;
}


function toggleLoader(show) {
    if (show) {
        $('#loader').removeClass('hidden').show();
    } else {
        $('#loader').addClass('hidden').hide();
    }
}

function sortProducts() {
    toggleLoader(true);
    const sortValue = $('#sort').val();
    const url = updateUrlParameter('sort', sortValue);
    console.log(sortValue);
    makeRequest(url);
}

function makeRequest(url){
    $.ajax({
        url: url,
        type: 'GET'
    }).done(function(response) {
        try {
            response = JSON.parse(response);        
            if (!response.success) {
                alert('Something went wrong');
            } else {
                updateProducts(response.data);
            }
        } catch (error) {
            alert('Invalid response format: not JSON');
        }
        toggleLoader(false);
    }).fail(function() {
        toggleLoader(false);
        alert('Something went wrong');
    })
}

function updateProducts(data){
    $('.product_list').html('');
    $(data).each(function(v,i) {
        let productTemplate = $('.product.hidden').clone();
        productTemplate.removeClass('hidden');
        productTemplate.find('h5').text(i.name);
        productTemplate.find('.card_price').text(i.price);
        productTemplate.find('button')
            .attr('data-name', i.name)
            .attr('data-price', i.price)
            .attr('data-quantity', i.quantity);
        $('.product_list').append(productTemplate);
      });
}

function init(){
    toggleLoader(true);
    const urlParams = new URLSearchParams(window.location.search);
    const sortParam = urlParams.get('sort');
    const sortSelect = $('#sort');
    const validSortValues = ["price_asc", "name_asc", "date_desc"];
    
    if (validSortValues.includes(sortParam)) {
        sortSelect.val(sortParam);
    } else {
        sortSelect.val('');
    }
    toggleLoader(false);
}