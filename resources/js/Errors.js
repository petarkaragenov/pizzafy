class Errors {
    constructor() {
        this.errors = {};
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0]
        }
    }

    has(field) {
        if (this.errors[field]) {
            return true;
        }
    }

    clear(field) {
        if (this.errors[field]) {
            delete this.errors[field]
        }
    }

    record(errors) {
        this.errors = errors
    }
}

export default Errors;