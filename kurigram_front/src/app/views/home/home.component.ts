import { Component } from '@angular/core';
import { PostsComponent } from '../posts/posts.component';
import { PostFormComponent } from '../new-post/new-post.component';
import { RequestService } from 'src/app/services/request.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent {
  constructor(){}
text: string = "";
user: string ="Juan";
}
