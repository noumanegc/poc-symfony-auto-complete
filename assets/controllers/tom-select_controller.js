// assets/controllers/tom-select_controller.js
import { Controller } from '@hotwired/stimulus';
import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.bootstrap5.css';

export default class extends Controller {
    static values = {
        minLength: { type: Number, default: 3 },
        delay: { type: Number, default: 200 },
        url: String,
        token: String
    }

    connect() {

        new TomSelect(this.element, {
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            placeholder: 'Sélectionnez un sujet...',

            shouldLoad: function (query) {
                return query.length >= 3;
            },

            loadThrottle: 200,

            load: (query, callback) => {
                if (!query.length) return callback();

                if (query.length < this.minLengthValue) {
                    return callback();
                }

                const url = `${this.urlValue}?q=${encodeURIComponent(query)}`;

                fetch(url)
                    .then(response => response.json())
                    .then(json => {
                        callback(json.results);
                    }).catch(() => {
                        callback();
                    });
            },
            render: {
                option: function (item, escape) {
                    return '<div>' + escape(item.name) + '</div>';
                },
                no_results: function () {
                    return '<div class="no-results">Aucun résultat trouvé</div>';
                },
                not_loading: function () {
                    return '<div class="not-loading">Entrez au moins 3 caractères...</div>';
                }
            },
            highlight: true,
        });
    }
}