import { Component, OnInit } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { User } from 'src/app/models/user';

@Component({
  selector: 'app-gente',
  templateUrl: './gente.component.html',
  styleUrls: ['./gente.component.css']
})
export class GenteComponent implements OnInit {
  users: User[] = [];

  constructor(private requestService: RequestService) {}

  ngOnInit() {
    this.getUsers();
  }

  getUsers() {
    this.requestService.getUsers().subscribe(users => {
      this.users = users;
    });
  }

  followUser(id: number) {
    const currentUserId = 123; // Obtener el ID del usuario actual
    this.requestService.followUser(currentUserId, id).subscribe(() => {
      // Actualizar la lista de usuarios para reflejar el cambio
      this.getUsers();
    });
  }

  unfollowUser(id: number) {
    const currentUserId = 123; // Obtener el ID del usuario actual
    this.requestService.unfollowUser(currentUserId, id).subscribe(() => {
      // Actualizar la lista de usuarios para reflejar el cambio
      this.getUsers();
    });
  }
}

