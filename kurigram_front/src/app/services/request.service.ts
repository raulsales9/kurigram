import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';

import { Events } from '../models/events';
import { Login } from '../models/login';
import { Registry } from '../models/registry';
import { User } from '../models/user';
import { AsistEvent } from '../models/AsistEvent';
import { Post } from '../models/post';

@Injectable({
  providedIn: 'root'
})
export class RequestService {

  constructor(public http : HttpClient) { }

  login = "http://localhost:8000/api/login";
  registry = "http://localhost:8000/api/insert/user";
  events = "http://localhost:8000/api/Todos";
  users = "http://localhost:8000/api/users";
  Singleuser = "http://localhost:8000/api/users/{id}";
  update = "http://localhost:8000/api/update/user";
  updateEvent = "http://localhost:8000/api/update/events"; 
  posts = "http://localhost:8000/api/posts";
  inserPosts ="http://localhost:8000/api/insert/post";
  GetFollowers ="http://localhost:8000/api/follows/{id}";
  FollowUser = "http://localhost:8000/api/followUser/{followerId}/{followedId}";
  UnfollowUser ="http://localhost:8000/api/unfollowUser/{followerId}/{followedId}";

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

  public registerUser(user: any) {
    return this.http.post<any>(this.registry, user);
  }

  public getEvents() : Observable<Events[]> {
    return this.http.get<Events[]>(this.events)
  }
  public getPosts(): Observable<Post[]> {
    return this.http.get<Post[]>(this.posts);
  }

  public followUser(followerId: number, followedId: number): Observable<any> {
    return this.http.post<any>(this.FollowUser + 'followUser/' + followerId + '/' + followedId, {});
  }

  public unfollowUser(followerId: number, followedId: number): Observable<any> {
    return this.http.post<any>(this.UnfollowUser + 'unfollowUser/' + followerId + '/' + followedId, {});
  }

  public isUserAuthenticated(): boolean {
    // Comprobar si existe un token de autenticación en el almacenamiento local o de sesión
    const token = localStorage.getItem('token') || sessionStorage.getItem('token');
    return !!token; // Devolver true si el token existe, false en caso contrario
  }

  public insertPost(post: Post): Observable<Post> {
    return this.http.post<Post>(this.inserPosts, post);
  }

  public registration(email : string, name : string,password : string, phone : string) : Observable<Registry> {
    return this.http.post<Registry>(this.registry, {
      "name" : name,
      "email" : email,
      "phone" : phone,
      "password" : password
    });
  }


  getUser(id?: number): Observable<User> {
    const url = id ? `${this.Singleuser}/${id}` : this.Singleuser;
    return this.http.get<User>(url);
  }

  getUsers(): Observable<User[]> {
    return this.http.get<User[]>(this.users);
  }

  
  public getFollowers(id: number): Observable<User[]> {
    const url = this.GetFollowers.replace('{id}', id.toString());
    return this.http.get<User[]>(url);
  }



  public getCurrentUser(): Observable<User> {
    // Obtener el identificador del usuario actual (p. ej., de la sesión o el token)
    const currentUserId = 123;
  
    // Llamar al método getUser() existente para obtener la información del usuario actual
    return this.getUser(currentUserId);
  }
  
  public getFollowingIds(userId: number): Observable<number[]> {
    const url = `${this.GetFollowers.replace('{id}', userId.toString())}`;
    return this.http.get<number[]>(url);
  }
  public updateUser(id : number, name : string, surnames : string, email : string, phone : string) : Observable<User> {
    return this.http.put<User>(this.update + id, {
      "name" : name,
      "surnames" : surnames,
      "email" : email,
      "phone" : phone
    })
  }

  public assistEvents(idUser : string | null, idEvent : number) : Observable<
  AsistEvent> {
    return this.http.put<AsistEvent>(this.updateEvent + idEvent + "/" + idUser,{});
  }

}
