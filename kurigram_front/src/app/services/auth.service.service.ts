import { Injectable } from '@angular/core';
import { Observable,BehaviorSubject } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { Login } from '../models/login';
import { Registry } from '../models/registry';
import { User } from '../models/user';
import { map } from 'rxjs/operators';
import jwt_decode from 'jwt-decode';
import { of } from 'rxjs';



@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private currentUserSubject: BehaviorSubject<any> = new BehaviorSubject<any>(null);
  public currentUser$: Observable<any> = this.currentUserSubject.asObservable();
  public isLoggedIn = false;
  

  constructor(public http: HttpClient) {}

  login = "http://localhost:8000/api/login";
  registry = "http://localhost:8000/api/insert/user";

  public loginOrRegister(user: any, isLogin: boolean): Observable<any> {
    if (isLogin) {
      return this.http.post<any>(this.login, user).pipe(
        map(response => {
          if (response.token) {
            const decodedToken: any = jwt_decode(response.token);
            const currentUser: User = {
              id: decodedToken.user_id,
              name: decodedToken.user_name,
              email: decodedToken.user_email,
              phone: '',
              events: []
            };
            this.setCurrentUser(currentUser);
            this.isLoggedIn = true;
            localStorage.setItem('token', response.token);
            sessionStorage.setItem('token', response.token);
          }
          return response;
        })
      );
    } else {
      return of(null);
    }
  }

  public isUserAuthenticated(): Observable<boolean> {
    const token = localStorage.getItem('token') || sessionStorage.getItem('token');
    if (!!token) {
      const decodedToken: any = jwt_decode(token);
      const currentUser: User = {
        id: decodedToken.user_id,
        name: decodedToken.user_name,
        email: decodedToken.user_email,
        phone: '',
        events: []
      };
      this.currentUser = currentUser;
      this.currentUserSubject.next(currentUser);
    } else {
      this.currentUser = null;
      this.currentUserSubject.next(null);
    }
    return of(!!token);
  }
  
  public setCurrentUser(user: User) {
    this.currentUser = user;
    this.currentUserSubject.next(user);
  }

  private currentUser: User | null = null;

 

  getCurrentUser() {
    return this.currentUser;
  }

  getCurrentUserId() {
    return this.currentUser ? this.currentUser.id : null;
  }

  public getLogs($email: string, $password: string): Observable<Login> {
    return this.http.post<Login>(this.login, { email: $email, password: $password });
  }

  public registerUser(user: Registry) {
    return this.http.post<any>(this.registry, user);
  }

  public registration(newRegistry: Registry): Observable<Registry> {
    return this.http.post<Registry>(this.registry, newRegistry);
  }

  public logout() {
    this.isLoggedIn = false;
    localStorage.removeItem('token');
    sessionStorage.removeItem('token');
  }
}