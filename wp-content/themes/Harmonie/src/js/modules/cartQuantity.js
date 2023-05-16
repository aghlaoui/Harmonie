import $ from 'jquery'

class QuantityChange {
    constructor() {
        this.quantityChange = $('.ec-pro-content');
        this.quantityInput = this.quantityChange.find('.qty-input');
        this.event();
    }
    event() {

        this.quantityInput.on("change", this.updateQuantity.bind(this));
    }
    updateQuantity() {
        key = this.quantityChange.find('.remove').data('key');
        console.log(key);
    }
}
export default QuantityChange