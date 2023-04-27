import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';




@Injectable({
  providedIn: 'root'
})
export class RequestService {

  constructor(public http : HttpClient) { }

  login = "http://localhost:8000/api/login";
  events = "http://localhost:8000/api/events";
  user = "http://localhost:8000/api/user";
  update = "http://localhost:8000/api/update/user";
  ChangeEvents = "http://localhost:8000/api/update/events"; 

  public getLogs($email : string, $password : string) : Observable<Logs> {
    return this.http.post.<Logs>(this.login, { email: $email, password: $password});
  }

}
