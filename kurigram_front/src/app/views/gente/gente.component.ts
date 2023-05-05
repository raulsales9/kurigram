import { Component, OnInit } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { User } from 'src/app/models/user';

@Component({
  selector: 'app-gente',
  templateUrl: './gente.component.html',
  styleUrls: ['./gente.component.css']
})
export class GenteComponent implements OnInit {

  users: User[];

  constructor(private requestService: RequestService) { }

  ngOnInit(): void {
    this.requestService.getUsers().subscribe(data => {
      this.users = data;
    });
  }
  followUser(userId: number, followeeId: number) {
    this.requestService.followUser(userId, followeeId).subscribe(data => {
      // Actualizar la lista de usuarios para reflejar el cambio
      this.requestService.getUsers().subscribe(users => {
        this.users = users;
      });
    });
  }
  
  unfollowUser(userId: number, followeeId: number) {
    this.requestService.unfollowUser(userId, followeeId).subscribe(data => {
      // Actualizar la lista de usuarios para reflejar el cambio
      this.requestService.getUsers().subscribe(users => {
        this.users = users;
      });
    });
  }
  }

