// Author: Emily Lin
export class User {
    // Reference: https://angular.io/guide/forms-overview
    constructor(
        public signUpEmail: string,
        public signUpPassword: string,
        public confirmPassword: string
    ) { }
}
