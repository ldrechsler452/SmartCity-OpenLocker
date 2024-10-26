import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { TLockerItem } from '@/types';
import { Head } from '@inertiajs/react';

export default function Dashboard({content}:{content: TLockerItem}) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Ausleihe
                </h2>
            }
        >
            <Head title="Ausleihe" />

            <div className="py-0 sm:py-12"> 
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <pre>{content && JSON.stringify(content, null, 2)}</pre>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
