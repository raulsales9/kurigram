export class User{
    constructor(
        public _id: string,
        public name: string,
        public email: string,
        public nick: string,
        public password: string,
        public role: string,
        public image: string
    ){}

    
}