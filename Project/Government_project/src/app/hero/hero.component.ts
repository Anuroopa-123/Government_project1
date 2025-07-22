import {
  Component,
  ViewChild,
  ElementRef,
  ChangeDetectorRef,
  OnInit,
  AfterViewChecked,
} from '@angular/core';
import { UnionStateRelationsComponent } from '../union-state-relations/union-state-relations.component';
import { ContentService } from '../services/content.service';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-hero',
  standalone: true,
  imports: [UnionStateRelationsComponent, FormsModule, CommonModule],
  templateUrl: './hero.component.html',
  styleUrl: './hero.component.css',
})
export class HeroComponent implements OnInit, AfterViewChecked {
  videoUrl: string | null = null;
  members: any[] = [];

  @ViewChild('heroVideo', { static: false })
  heroVideo!: ElementRef<HTMLVideoElement>;

  private hasTriedPlay = false;

  constructor(
    private contentService: ContentService,
    private cdr: ChangeDetectorRef
  ) {}

  ngOnInit() {
    // Load hero video content
    this.contentService.getHeroContent().subscribe((response) => {
      if (response.status === 'success' && response.data.length > 0) {
        this.videoUrl = response.data[0].video_url ?? null;
        this.cdr.detectChanges();
      }
    });

    this.contentService.getMembers().subscribe((response) => {
      if (response.status === 'success' && response.data.length > 0) {
        this.members = response.data.map((item: any) => ({
          name: item.title,
          description: item.description,
          image: item.news_image,
          role: item.role,
        }));
        console.log(this.members);
        this.cdr.detectChanges();
      } else {
        console.log('No members found or failed to load members');
      }
    });
  }

  ngAfterViewChecked() {
    if (this.videoUrl && this.heroVideo && !this.hasTriedPlay) {
      this.hasTriedPlay = true;
      this.tryPlayVideo();
    }
  }

  tryPlayVideo() {
    const videoEl = this.heroVideo.nativeElement;
    if (!videoEl) return;

    videoEl.muted = true;
    videoEl.play().catch((error) => {
      console.warn('Autoplay prevented:', error);
      this.addUserInteractionToPlay(videoEl);
    });
  }

  addUserInteractionToPlay(videoEl: HTMLVideoElement) {
    const events = ['click', 'touchstart', 'keydown'];
    const playOnUserGesture = () => {
      videoEl
        .play()
        .catch((err) =>
          console.warn('Play failed after user interaction:', err)
        );
      events.forEach((event) =>
        window.removeEventListener(event, playOnUserGesture)
      );
    };
    events.forEach((event) =>
      window.addEventListener(event, playOnUserGesture)
    );
  }
}
