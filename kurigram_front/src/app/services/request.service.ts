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
  user = "http://localhost:8000/api/users";
  update = "http://localhost:8000/api/update/user";
  updateEvent = "http://localhost:8000/api/update/events"; 
  posts = "http://localhost:8000/api/posts";
  inserPosts ="http://localhost:8000/api/insert/post";
  GetFollowers ="http://localhost:8000/api/follows/{id}";
  FollowUser = "http://localhost:8000/api/followUser/{followerId}/{followedId}";
  UnfollowUser ="http://localhost:8000/api/unfollowUser/{followerId}/{followedId}";

  public getLogs($email : string, $password : string) : Observable<Login> {
    return this.http.post<Login>(this.login, { email: $email, password: $password});
  }

  public getEvents() : Observable<Events[]> {
    return this.http.get<Events[]>(this.events)
  }
  public getPosts(): Observable<Post[]> {
    return this.http.get<Post[]>(this.posts);
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

  public getUser(id?: number): Observable<User> {
    const url = id ? this.user + id : this.user;
    return this.http.get<User>(url);
  }
  public getUsers(): Observable<User[]> {
    return this.http.get<User[]>(this.user);
  }

  
  public getFollowers(id: number): Observable<User[]> {
    const url = this.GetFollowers.replace('{id}', id.toString());
    return this.http.get<User[]>(url);
  }

  public followUser(followerId: number, followeeId: number): Observable<any> {
    const url = this.FollowUser.replace('{id}', followerId.toString()).replace('{id}', followeeId.toString());
    return this.http.put(url, {});
  }

  unfollowUser(userId: number, followeeId: number) {
    const url = `${this.unfollowUser}/users/${userId}/follow`;
    return this.http.delete(url, { params: { followeeId: followeeId.toString() } });
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
