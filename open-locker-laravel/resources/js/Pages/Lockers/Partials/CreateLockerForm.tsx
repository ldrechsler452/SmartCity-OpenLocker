import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Station } from '@/types';
import { Transition } from '@headlessui/react';
import { useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

export default function CreateLocker({
    className = '',
    station,
}: {
    station: Station;
    className?: string;
}) {
    const { data, setData, post, errors, processing, recentlySuccessful } =
        useForm({
            lockerDesignation: '',
            itemName: '',
            image: null as File | null,
            station_id: station?.id ?? '1', 
        });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('locker.store'));
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Gegenstand erstellen
                </h2>

                <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Erstelle eine neuen Gegenstand.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="name" value="Name des Schliessfachs" />

                    <TextInput
                        id="lockerDesignation"
                        className="mt-1 block w-full"
                        value={data.lockerDesignation}
                        onChange={(e) => setData('lockerDesignation', e.target.value)}
                        required
                        isFocused
                        autoComplete="name"
                    />

                    <InputError className="mt-2" message={errors.lockerDesignation} />
                </div>

                <div>
                    <InputLabel htmlFor="itemName" value="Name des Gegenstandes" />

                    <TextInput
                        id="itemName"
                        type="text"
                        className="mt-1 block w-full"
                        value={data.itemName}
                        onChange={(e) => setData('itemName', e.target.value)}
                        required
                        autoComplete="itemName"
                    />

                    <InputError className="mt-2" message={errors.itemName} />
                </div>

                <div>
                    <InputLabel htmlFor="image" value="Bild" />
                    <input type="file" onChange={e => {
                        if (e.target.files && e.target.files[0]) {
                            setData('image', e.target.files[0]);
                        }
                    }} />

                    <InputError className="mt-2" message={errors.image} />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Save</PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-600 dark:text-gray-400">
                            Saved.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
