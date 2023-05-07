import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { Login } from '../models/login';
import { Registry } from '../models/registry';
import { User } from '../models/user';


@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(public http : HttpClient) { }

  login = "http://localhost:8000/api/login";
  registry = "http://localhost:8000/api/insert/user";


  public loginOrRegister(user: any, isLogin: boolean): Observable<any> {
    if (isLogin) {
      return this.http.post<any>(this.login, user);
    } else {
      return this.http.post<any>(this.registry, user);
    }
  }

  public getLogs($email : string, $password : string) : Observable<Login> {
    return this.http.post<Login>(this.login, { email: $email, password: $password});
  }

  public registerUser(user: Registry) {
    return this.http.post<any>(this.registry, user);
  }

  public registration(newRegistry: Registry): Observable<Registry> {
    return this.http.post<Registry>(this.registry, newRegistry);
  }

}
