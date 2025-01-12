// assets/controllers/select2_controller.js
import { Controller } from '@hotwired/stimulus';
import jquery from 'jquery';
import 'select2';

export default class extends Controller {
    connect() {
        const $ = jquery;
        $(this.element).select2({
            ajax: {
                url: this.element.dataset.select2AjaxUrl,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            },
            minimumInputLength: 3,
            placeholder: this.element.dataset.placeholder || 'Sélectionnez...',
            language: "fr"
        });
    }

    disconnect() {
        const $ = jquery;
        $(this.element).select2('destroy');
    }
}