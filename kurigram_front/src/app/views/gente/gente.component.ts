import { Component } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { User } from '../profile/profile.interface';
@Component({
  selector: 'app-gente',
  templateUrl: './gente.component.html',
  styleUrls: ['./gente.component.css']
})
export class GenteComponent {
  constructor(private requestService: RequestService) { }

  users: any[];

/*   ngOnInit() {
    this.requestService.getUser().subscribe((data: any[]) => {
      this.users = data;
    });
  } */
}