export interface Resume {
    id: string;
    user_id: number;
    full_name: string;
    email: string;
    current_position: string;
    experience: number;
    technologies: string;
    image_path: string;
    companies: object;
    job_description: string;
    job_responsibilities: string;
    job_achievements: string;
}
