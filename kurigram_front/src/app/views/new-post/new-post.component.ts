import { Component, OnInit } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { Post } from 'src/app/models/post';

@Component({
  selector: 'app-post-form',
  templateUrl: './new-post.component.html',
})
export class PostFormComponent {

  newPost: Post = {
    _id: '6',
    created_at: '',
    title: '',
    text: '',
    isSubmitted: 0,
    image: '',
    user: '',
    likes: 0
  };

  constructor(private requestService: RequestService) {}

  onSubmit(): void {
    this.requestService.insertPost(this.newPost).subscribe((post: Post) => {
      console.log(post);
      this.newPost = {
        _id: '6',
        created_at: '',
        title: '',
        text: '',
        isSubmitted: 0,
        image: '',
        user: '',
        likes: 0
      };
    });
  }

}
  
  